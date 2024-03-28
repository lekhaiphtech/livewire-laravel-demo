<div class="container">
    <div class="card m-auto mt-5  border-0 shadow-sm" style="max-width: 50rem;">
        <div class="card-header text-center">
            @if($step === 1)
            Page 1: Personal Information
            @elseif($step === 2)
            Page 2: Other Information
            @else
            Final Result
            @endif
        </div>
        <div class="card-body">
            <form wire:submit.prevent="submitForm">
                @if($step === 1)
                <div class="row g-3">
                    <div class="col">
                        <div class="form-floating">
                            <input type="text" class="form-control @error('formData.first_name') is-invalid @enderror"
                                wire:model.live="formData.first_name" id="first_name" placeholder="Enter First name...">
                            <label for="first_name">First name:</label>
                        </div>
                        @error('formData.first_name') <span class="badge text-danger fw-normal">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col">
                        <div class="form-floating">
                            <input type="text" class="form-control @error('formData.last_name') is-invalid @enderror"
                                wire:model.live="formData.last_name" id="last_name" placeholder="Enter Last name...">
                            <label for="last_name">Last name:</label>
                        </div>
                        @error('formData.last_name') <span class="badge text-danger fw-normal">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-12">
                        <div class="form-floating">
                            <textarea class="form-control  @error('formData.address') is-invalid @enderror"
                                placeholder="Address..." id="address" wire:model.live="formData.address"
                                style="height: 100px"></textarea>
                            <label for="address">Address</label>
                        </div>
                        @error('formData.address') <span class="badge text-danger fw-normal">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col">
                        <div class="form-floating">
                            <input type="text" class="form-control @error('formData.city') is-invalid @enderror"
                                wire:model.live="formData.city" id="city" placeholder="Enter City...">
                            <label for="city">City:</label>
                        </div>
                        @error('formData.city') <span class="badge text-danger fw-normal">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col">
                        <div class="form-floating">
                            <input type="text" class="form-control @error('formData.country') is-invalid @enderror"
                                wire:model.live="formData.country" id="country" placeholder="Enter Country...">
                            <label for="country">Country:</label>
                        </div>
                        @error('formData.country') <span class="badge text-danger fw-normal">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Date of Birth</label>
                        <div class="row g-2">
                            <div class="col">
                                <select wire:model.live="formData.dob_date"
                                    class="form-select @error('formData.dob_date') is-invalid @enderror">
                                    <option value="">Day</option>
                                    @foreach($days as $day)
                                    <option value="{{ $day }}">{{ $day }}</option>
                                    @endforeach
                                </select>
                                @error('formData.dob_date') <span class="badge text-danger fw-normal">{{ $message
                                    }}</span>
                                @enderror
                            </div>
                            <div class="col">
                                <select wire:model.live="formData.dob_month"
                                    class="form-select @error('formData.dob_month') is-invalid @enderror">
                                    <option value="">Month</option>
                                    @foreach($months as $monthNum => $monthName)
                                    <option value="{{ $monthNum }}">{{ $monthName }}</option>
                                    @endforeach
                                </select>
                                @error('formData.dob_month') <span class="badge text-danger fw-normal">{{ $message
                                    }}</span>
                                @enderror
                            </div>
                            <div class="col">
                                <select wire:model.live="formData.dob_year"
                                    class="form-select @error('formData.dob_year') is-invalid @enderror">
                                    <option value="">Year</option>
                                    @foreach($years as $year)
                                    <option value="{{ $year }}">{{ $year }}</option>
                                    @endforeach
                                </select>
                                @error('formData.dob_year') <span class="badge text-danger fw-normal">{{ $message
                                    }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="row">
                            <div class="col text-end">
                                <button type="button" wire:click="nextStep" class="btn btn-primary px-4">Next</button>
                            </div>
                        </div>
                    </div>
                </div>
                @elseif($step === 2)
                <div>
                    <div class="mb-3">
                        <label class="form-label">Are you married?</label>
                        <div class="form-check">
                            <input type="radio" wire:model.live="formData.marital_status" value="1" id="married_yes">
                            <label class="form-check-label" for="married_yes">Yes</label>
                        </div>
                        <div class="form-check">
                            <input type="radio" wire:model.live="formData.marital_status" value="0" id="married_no">
                            <label class="form-check-label" for="married_no">No</label>
                        </div>

                        @error('formData.marital_status')
                        <span class="badge text-danger fw-normal">
                            {{ $message }}
                        </span>
                        @enderror
                    </div>

                    @if($formData['marital_status'])
                    <div class="mb-3">
                        <label class="form-label" for="date_of_marriage">Date of Marriage:</label>
                        <!-- Separate fields for month, day, year -->
                        <div class="row g-2">
                            <div class="col">
                                <select wire:model.live="formData.date_of_marriage"
                                    class="form-select @error('formData.date_of_marriage') is-invalid @enderror">
                                    <option value="">Day</option>
                                    @foreach($days as $day)
                                    <option value="{{ $day }}">{{ $day }}</option>
                                    @endforeach
                                </select>
                                @error('formData.date_of_marriage') <span class="badge text-danger fw-normal">{{
                                    $message }}</span>
                                @enderror
                            </div>
                            <div class="col">
                                <select wire:model.live="formData.month_of_marriage"
                                    class="form-select @error('formData.month_of_marriage') is-invalid @enderror">
                                    <option value="">Month</option>
                                    @foreach($months as $monthNum => $monthName)
                                    <option value="{{ $monthNum }}">{{ $monthName }}</option>
                                    @endforeach
                                </select>
                                @error('formData.month_of_marriage') <span class="badge text-danger fw-normal">{{
                                    $message }}</span>
                                @enderror
                            </div>
                            <div class="col">
                                <select wire:model.live="formData.year_of_marriage"
                                    class="form-select @error('formData.year_of_marriage') is-invalid @enderror">
                                    <option value="">Year</option>
                                    @foreach($years as $year)
                                    <option value="{{ $year }}">{{ $year }}</option>
                                    @endforeach
                                </select>
                                @error('formData.year_of_marriage') <span class="badge text-danger fw-normal">{{
                                    $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="country_of_marriage">Country of Marriage:</label>
                        <input type="text" wire:model.live="formData.country_of_marriage"
                            class="form-control @error('formData.country_of_marriage') is-invalid @enderror"
                            id="country_of_marriage">

                        @error('formData.country_of_marriage')
                        <span class="badge text-danger fw-normal">
                            {{ $message }}
                        </span>
                        @enderror
                    </div>
                    @endif

                    @if($formData['marital_status'] === '0')
                    <div class="mb-3">
                        <label class="form-label">Are you widowed?</label>
                        <div class="form-check">
                            <input type="radio" wire:model.live="formData.is_widow" value="1" id="widowed_yes">
                            <label class="form-check-label" for="widowed_yes">Yes</label>
                        </div>
                        <div class="form-check">
                            <input type="radio" wire:model.live="formData.is_widow" value="0" id="widowed_no">
                            <label class="form-check-label" for="widowed_no">No</label>
                        </div>
                        @error('formData.is_widow')
                        <span class="badge text-danger fw-normal">
                            {{ $message }}
                        </span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Have you ever been married in the past?</label>
                        <div class="form-check">
                            <input type="radio" wire:model.live="formData.previously_married" value="yes"
                                id="prev_married_yes">
                            <label class="form-check-label" for="prev_married_yes">Yes</label>
                        </div>
                        <div class="form-check">
                            <input type="radio" wire:model.live="formData.previously_married" value="no"
                                id="prev_married_no">
                            <label class="form-check-label" for="prev_married_no">No</label>
                        </div>
                        @error('formData.previously_married')
                        <span class="badge text-danger fw-normal">
                            {{ $message }}
                        </span>
                        @enderror
                    </div>
                    @endif
                    <div class="row">
                        <div class="col text-start">
                            <button type="button" wire:click="prevStep" class="btn btn-primary px-4">Previous</button>
                        </div>
                        <div class="col text-end">
                            <button type="submit" class="btn btn-primary px-4">Submit</button>
                        </div>
                    </div>
                </div>
                @else
                <ul>
                    <li>Name : {{$formData['first_name']}} {{$formData['last_name']}}</li>
                    <li>Address : {{$formData['address']}}</li>
                    <li>City : {{$formData['city']}}</li>
                    <li>Country : {{$formData['country']}}</li>
                    <li>
                        Date of birth : {{$formData['dob_date']}}-{{$formData['dob_month']}}-{{$formData['dob_year']}}
                    </li>
                    <li>Country : {{$formData['country']}}</li>
                    <li>Married : @if ($formData['marital_status'] === '0') No @else Yes @endif</li>
                    @if ($formData['marital_status'] === '1')
                    <li>
                        Date of marriage :
                        {{$formData['date_of_marriage']}}-{{$formData['month_of_marriage']}}-{{$formData['year_of_marriage']}}
                    </li>
                    <li>
                        Country Where Married : {{$formData['country_of_marriage']}}
                    </li>
                    @endif
                    @if ($formData['marital_status'] === '0')
                    <li>
                        Widow :
                        @if ($formData['is_widow'] === '0') No @else Yes @endif
                    </li>
                    <li>
                        Previously Married : {{$formData['previously_married']}}
                    </li>
                    @endif
                </ul>
                @endif
            </form>
        </div>
    </div>
    <!-- Toast message -->
    <div class="position-fixed top-0 end-0 p-3">
        <div id="toast" class="toast align-items-center text-white bg-danger" role="alert" aria-live="assertive"
            aria-atomic="true">
            <div class="d-flex">
                <div class="toast-body">
                    {{ $toastMessage }}
                </div>
                <button type="button" class="btn-close me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            Livewire.on('show-toast', function () {
                var toastElement = document.getElementById('toast');
                var toast = new bootstrap.Toast(toastElement);
                toast.show();
            });
        });
    </script>
    @endpush
</div>