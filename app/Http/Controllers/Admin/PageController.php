<?php

namespace App\Http\Controllers\Admin;


use App\Enums\WebshopEnum;
use App\Http\Controllers\Admin\BaseAdminController;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\UpdateHomePageContentRequest;
use App\Models\Contact;
use App\Models\Page;
use App\Models\Webshop;
use App\Services\Api\BolService;
use App\Services\ContactService;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use Throwable;

class PageController extends BaseAdminController
{

    public function __construct(protected ContactService $service)
    {
        $this->page_title = "Pages";
        $this->base_view_path = "admin.pages";
    }
    public function edit($slug, Request $request)
    {
        $page = Page::query()->whereSlug($slug)->first();
        $data['page'] = $page;
        return view("{$this->base_view_path}.edit", $data);
    }

    public function editHomePage()
    {
        $page = Page::query()->whereSlug('home')->first();
        $data['page'] = $page;
        $data['content'] = json_decode($page->content, true);
        return view("{$this->base_view_path}.home", $data);
    }

    public function update(Request $request, $slug)
    {
        $page = Page::query()->whereSlug($slug)->first();
        $page->update($request->all());
        return generateApiResoponse(true, 200, message: __('response.success_updated'), data: $page);
    }

    public function updateHomePage(UpdateHomePageContentRequest $request)
    {
        try {
            $content = $request->except('_token');
            foreach ($content['sliders'] as $key => $slider) {
                // Check if a new image is uploaded
                if (isset($slider['image']) && $slider['image'] instanceof UploadedFile) {
                    $content['sliders'][$key]['image'] = saveImage('home', $slider['image']);
                } else {
                    // Use the existing image if no new image is uploaded
                    $content['sliders'][$key]['image'] = $slider['existing_image'];
                }
                // Remove the temporary existing_image field
                unset($content['sliders'][$key]['existing_image']);
            }
            Page::query()->whereSlug('home')->update(['content' => json_encode($content)]);
            Cache::forget('home_page_sliders');
            return generateApiResoponse(true, 200, message: __('response.success_updated'));
        } catch (Throwable $e) {
            Log::error("Fail with Creation in Model : " . get_class($this) . " error:" . $e->getMessage());
            return generateResponse(status: false, message: __('response.failed_created'));
        }
    }
}
