<div class="modal fade" id="order-modal" tabindex="-1" aria-labelledby="LoginForm-title" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content rounded shadow border-0">
            <form name="contact-form" class="custom-form">
                <div class="modal-header border-bottom">
                    <h5 class="modal-title" id="modal-title"></h5>
                    <button type="button" class="btn btn-icon btn-close" data-bs-dismiss="modal" id="close-modal"><i
                            class="uil uil-times fs-4 text-dark"></i></button>
                </div>
                <div class="modal-body">
                    <div class="p-3 rounded box-shadow">
                        <d class="row">
                            <div class="col-md-12 text-center">
                                <div class="mb-3">
                                    <img src="" alt="" id="platform-image" width="100" height="100">
                                </div>
                            </div><!--end col-->
                            <div class="col-md-12 text-center">
                                <div class="mb-3">
                                    <img src="" alt="" id="service-image" width="100" height="100">
                                </div>
                            </div><!--end col-->
                            <div class="col-md-12 text-center">
                                <div class="mb-3">
                                    <h3 id="service-name"></h3>
                                </div>
                            </div><!--end col-->
                        </d iv><!--end row-->
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary"
                        data-bs-dismiss="modal">{{ __('general.close') }}</button>
                    <button type="submit" class="btn btn-primary">{{ __('general.confirm') }}</button>
                </div>
            </form>
        </div>
    </div>
</div>
