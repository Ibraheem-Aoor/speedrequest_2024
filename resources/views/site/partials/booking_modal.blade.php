<!-- Booking Modal -->
<div class="modal fade" id="bookingModal" tabindex="-1" aria-labelledby="bookingModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header" style="background: black;">
                <h5 class="modal-title" id="modal-title">{{ __('site.book_service') }}</h5>
                <button type="button" class="btn-close" style="color: white;background:#d3ad3a !important;"
                    data-bs-dismiss="modal" aria-label="Close">X</button>
            </div>
            {{-- <form id="bookingForm" method="POST" action="{{ route('bookings.store') }}"> --}}
            <form id="bookingForm" method="POST" action="{{ route('site.booking.store') }}" class="custom-form">
                @csrf
                <div class="modal-body">
                    <!-- Step 1: Select Services -->
                    <div id="step1">
                        <div class="mb-3">
                            <label class="form-label">{{ __('Select Services') }}</label>
                            @foreach ($services as $service)
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="service{{ $service->id }}"
                                        name="service_ids[]" value="{{ $service->id }}">
                                    <label class="form-check-label" for="service{{ $service->id }}">
                                        {{ $service->title }} - {{ formatPrice($service->price) }}
                                    </label>
                                </div>
                            @endforeach
                        </div>
                        <button type="button" class="btn btn-primary"
                            onclick="showStep(2)">{{ __('Next') }}</button>
                    </div>

                    <!-- Step 2: Select Date and Time -->
                    <div id="step2" style="display: none;">
                        <div class="mb-3">
                            <label for="date" class="form-label">{{ __('Select Date') }}</label>
                            <input type="date" class="form-control" id="date" name="date" required>
                        </div>
                        <div class="mb-3">
                            <label for="time" class="form-label">{{ __('Select Time') }}</label>
                            <select class="form-select" id="time" name="time" required>
                                <!-- Available times will be populated here by JavaScript -->
                            </select>
                        </div>
                        <button type="button" class="btn btn-secondary"
                            onclick="showStep(1)">{{ __('Back') }}</button>
                        <button type="button" class="btn btn-primary"
                            onclick="showStep(3)">{{ __('Next') }}</button>
                    </div>

                    <!-- Step 3: Select Barber -->
                    <div id="step3" style="display: none;">
                        <div class="mb-3">
                            <label class="form-label">{{ __('Select Barber') }}</label>
                            @foreach ($barbers as $barber)
                                <div class="form-check d-flex align-items-center">
                                    <input class="form-check-input me-2" type="radio" id="barber{{ $barber->id }}"
                                        name="barber_id" value="{{ $barber->id }}">
                                    <label class="form-check-label d-flex align-items-center"
                                        for="barber{{ $barber->id }}">
                                        @if ($barber->image)
                                            <img src="{{ getImageUrl($barber->image) }}" alt="{{ $barber->name }}"
                                                class="rounded-circle me-2" style="width: 40px; height: 40px;">
                                        @endif
                                        {{ $barber->name }}
                                    </label>
                                </div>
                            @endforeach
                        </div>
                        <button type="button" class="btn btn-secondary"
                            onclick="showStep(2)">{{ __('Back') }}</button>
                        <button type="button" class="btn btn-primary"
                            onclick="showStep(4)">{{ __('Next') }}</button>
                    </div>

                    <!-- Step 4: Client Information -->
                    <div id="step4" style="display: none;">
                        <div class="mb-3">
                            <label for="client_name" class="form-label">{{ __('Client Name') }}</label>
                            <input type="text" class="form-control" id="client_name" name="client_name" required>
                        </div>
                        <div class="mb-3">
                            <label for="client_phone" class="form-label">{{ __('Client Phone') }}</label>
                            <input type="text" class="form-control" id="client_phone" name="client_phone" required>
                        </div>
                        <button type="button" class="btn btn-secondary"
                            onclick="showStep(3)">{{ __('Back') }}</button>
                        <button type="submit" class="btn btn-primary">{{ __('Book Now') }}</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

@push('js')
    <script>
        function showStep(step) {
            document.getElementById('step1').style.display = step === 1 ? 'block' : 'none';
            document.getElementById('step2').style.display = step === 2 ? 'block' : 'none';
            document.getElementById('step3').style.display = step === 3 ? 'block' : 'none';
            document.getElementById('step4').style.display = step === 4 ? 'block' : 'none';
        }
        $(document).ready(function() {
            $('#date').on('change', function() {
                var date = $(this).val();
                fetchAvailableTimes(date);
            });

            function fetchAvailableTimes(date) {
                var serviceIds = [];
                $('input[name="service_ids[]"]:checked').each(function() {
                    serviceIds.push($(this).val());
                });
                $.ajax({
                    url: '{{ route('site.booking.fetch_available_times') }}',
                    type: 'GET',
                    data: {
                        date: date,
                        service_ids: serviceIds,
                    },
                    success: function(response) {
                        var times = response.available_times;
                        var timeSelect = $('#time');
                        timeSelect.empty();
                        if (times.length > 0) {
                            times.forEach(function(time) {
                                timeSelect.append(new Option(time, time));
                            });
                        } else {
                            timeSelect.append(new Option('{{ __('No available times') }}', ''));
                        }
                    }
                });
            }
        });
    </script>
@endpush
