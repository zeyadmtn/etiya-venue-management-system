    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment-with-locales.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/3.1.3/js/bootstrap-datetimepicker.min.js"></script>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/3.1.3/css/bootstrap-datetimepicker.min.css" rel="stylesheet" />
    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" />
    <script>
        // function nextDay() {
        //     let today = new Date();
        //     let nextDay = new Date(today.getFullYear(), today.getMonth(), today.getDate() + 1);
        //     let dd = nextDay.getDate();
        //     let mm = nextDay.getMonth() + 1;
        //     let yyyy = nextDay.getFullYear();
        //     if (dd < 10) {
        //         dd = '0' + dd;
        //     }
        //     if (mm < 10) {
        //         mm = '0' + mm;
        //     }
        //     return yyyy + '-' + mm + '-' + dd;
        // }
        $(document).ready(function() {
            // Initialize datetimepicker
            $('.input-group.date').datetimepicker({
                autoclose: true,
                format: 'dd-mm-yyyy'
            });
        });
    </script>

    <x-app-layout>
        <div class="py-5 tester">
            <div class="flex flex-col mx-auto p-5 bg-purple-100 w-3/5">
                <div class="text-2xl mb-10 mx-auto font-bold">
                    Venue Details
                </div>
                <form method="POST" action="{{ route('createBooking', $venue) }}" enctype="multipart/form-data">
                    @csrf
                    <!-- Name -->
                    <div>
                        <x-input-label for=" name" :value="__('Name')" />
                        <div class="text-2xl my-4 font-bold">{{$venue->name}}</div>
                    </div>

                    <!-- Capacity -->
                    <div class="mt-4">
                        <x-input-label for="capacity" :value="__('Capcity')" />
                        <div class="text-2xl my-4 font-bold">{{$venue->capacity}}</div>

                    </div>

                    <!-- Equipment -->
                    <div class="mt-4">
                        <x-input-label for="equipment" :value="__('Equipment')" />
                        <div class="text-2xl my-4 font-bold">{{$venue->equipment}}</div>

                    </div>

                    <!-- Deposit -->
                    <div class="mt-4">
                        <x-input-label for="deposit_price" :value="__('Deposit Price (RM)')" />
                        <div class="text-2xl my-4 font-bold">{{$venue->deposit_price}}</div>

                    </div>

                    <!-- Dailt Rate -->
                    <div class="mt-4">
                        <x-input-label for="daily_rate" :value="__('Daily Rate (RM)')" />
                        <div class="text-2xl my-4 font-bold">{{$venue->daily_rate}}</div>
                    </div>

                    <!-- Images -->
                    <div class="mt-4">
                        <x-input-label for="images" :value="__('Images')" />
                        <div class="flex flex-row justify-evenly my-4">
                            @isset($venue->images)
                            @foreach ($venue->images as $image )
                            <img src="data:image/jpeg;base64,{{ base64_encode($image) }}" alt="{{ $venue->name }}" class="h-auto w-72 object-contain">
                            @endforeach
                            @endisset
                        </div>
                    </div>

                    <div class="mt-4">
                        <x-input-label for="daily_rate" :value="__('Venue Availability')" />

                        <div class="mt-5" x-data="{ startDate: null, endDate: null }">
                            <label for="start-date">Start Date:</label>
                            <input type="date" name="start_date" id="start-date" x-model="startDate" :min="nextDay()" required />
                            <div class="container">
                                <h1>Bootstrap Datepicker - Date Range</h1>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Start Date:</label>
                                            <div class="input-group date">
                                                <input type="text" class="form-control" id="start-date">
                                                <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>End Date:</label>
                                            <div class="input-group date">
                                                <input type="text" class="form-control" id="end-date">
                                                <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <script>
                                // Initialize the datepicker
                                $(document).ready(function() {
                                    // Datepicker options
                                    var datepickerOptions = {
                                        format: 'yyyy-mm-dd',
                                        autoclose: true,
                                        todayHighlight: true
                                    };
                                    // Initialize the datepicker for the start date input
                                    $('#start-date').datepicker(datepickerOptions).on('changeDate', function(e) {
                                        // Set the minimum date of the end date input to the selected start date
                                        $('#end-date').datepicker('setStartDate', e.date);
                                    });
                                    // Initialize the datepicker for the end date input
                                    $('#end-date').datepicker(datepickerOptions).on('changeDate', function(e) {
                                        // Set the maximum date of the start date input to the selected end date
                                        $('#start-date').datepicker('setEndDate', e.date);
                                    });
                                });
                            </script>



                            <label for="end-date">End Date:</label>
                            <input type="date" name="end_date" id="end-date" x-model="endDate" :disabled="!startDate" :min="startDate" required />
                        </div>

                    </div>

                    <div class="flex items-center justify-center mt-8">
                        <x-primary-button class="ml-4">
                            {{ __('Book Venue') }}
                        </x-primary-button>
                    </div>
                </form>
            </div>

        </div>
    </x-app-layout>