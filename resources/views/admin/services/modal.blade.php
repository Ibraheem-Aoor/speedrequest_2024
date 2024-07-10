<div class="modal fade" id="service-modal" tabindex="-1" aria-labelledby="LoginForm-title" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content rounded shadow border-0">
            <form name="service-form" class="custom-form">
                <div class="modal-header border-bottom">
                    <h5 class="modal-title" id="modal-title"></h5>
                    <button type="button" class="btn btn-icon btn-close" data-bs-dismiss="modal" id="close-modal"><i
                            class="uil uil-times fs-4 text-dark"></i></button>
                </div>
                <div class="modal-body">
                    <div class="p-3 rounded box-shadow">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="avatar-picture">
                                    <div class="image-input image-input-outline" id="imgUserProfile">
                                        <div class="image-input-wrapper"
                                            style="background-image: url('{{ asset('assets/common/product-placeholder.webp') }}');">
                                        </div>
                                        <label class="btn">
                                            <i>
                                                <img src="{{ asset('assets/common/edit.svg') }}" alt=""
                                                    class="img-fluid">
                                            </i>
                                            <input type="file" name="image" id="changeImg" accept="image/*">
                                            <input type="button" value="Upload" id="uploadButton">
                                        </label>
                                    </div>

                                </div><!--end col-->
                                <div class="mb-3">
                                    <label class="form-label">{{ __('general.title') }}<span
                                            class="text-danger">*</span></label>
                                    <div class="form-icon position-relative">
                                        <input type="text" name="title" id="title" required
                                            class="form-control">
                                    </div>
                                </div>
                            </div><!--end col-->
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label class="form-label">{{ __('general.task_title') }}<span
                                            class="text-danger">*</span></label>
                                    <div class="form-icon position-relative">
                                        <input type="text" name="task_title" id="task_title" required
                                            class="form-control">
                                    </div>
                                </div>
                            </div><!--end col-->
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label class="form-label">{{ __('general.offer_url') }}<span
                                            class="text-danger">*</span></label>
                                    <div class="form-icon position-relative">
                                        <input type="text" name="offer_url" id="offer_url" required
                                            class="form-control">
                                    </div>
                                </div>
                            </div><!--end col-->
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label class="form-label">{{ __('general.platform') }}<span
                                            class="text-danger">*</span></label>
                                    <div class="form-icon position-relative">
                                        <select name="platform_id" id="platform_id" class="form-control">
                                            @foreach ($platforms as $platform)
                                                <option value="{{ $platform->id }}">{{ $platform->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div><!--end col-->
                            <div class="col-sm-12" id="features-btn">
                                <div>

                                    <label for="">{{ __('general.features') }}:</label>
                                    <button type="button" class="add_feature btn btn-xs btn-primary mb-2"
                                        onclick="addNewFeature($(this));"><i class="fa fa-plus"></i></button>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label class="form-label">{{ __('general.status') }}</label>
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" id="status" name="status"
                                            checked>
                                    </div>
                                </div>
                            </div><!--end col-->
                        </div><!--end row-->
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary"
                        data-bs-dismiss="modal">{{ __('general.close') }}</button>
                    <button type="submit" class="btn btn-primary">{{ __('general.save') }}</button>
                </div>
            </form>
        </div>
    </div>
</div>
