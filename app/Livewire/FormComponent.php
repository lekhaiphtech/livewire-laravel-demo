<?php

namespace App\Livewire;

use App\Models\LiveWireUserInfo;
use Carbon\Carbon;
use Livewire\Component;
class FormComponent extends Component {
    public $step;
    public $months;
    public $days;
    public $years;
    public $toastMessage;

    public $formData = [
        'first_name' => '',
        'last_name' => '',
        'address' => '',
        'city' => '',
        'country' => '',
        'dob_month' => '',
        'dob_date' => '',
        'dob_year' => '',
        'marital_status' => '',
        'month_of_marriage' => '',
        'country_of_marriage' => '',
        'is_widow' => '',
        'previously_married' => ''
    ];
    
    public function mount() {
        $this->step = 1;
        $this->formData['marital_status'] = '';

        // Load values for months, days, and years
        $this->months = [
            1 => 'January', 2 => 'February', 3 => 'March', 4 => 'April', 
            5 => 'May', 6 => 'June', 7 => 'July', 8 => 'August', 
            9 => 'September', 10 => 'October', 11 => 'November', 12 => 'December'
        ];
        $this->days = range(1, 31);
        $this->years = range(date('Y') - 100, date('Y')); // Assuming 100 years is the maximum range
    }

    public function updated($propertyName)
    {
        $this->resetValidation($propertyName);
    }

    public function render()
    {
        return view('livewire.form-component');
    }

    public function nextStep()
    {
        $validateFirstStep = $this->validateStepOne();
        if($validateFirstStep) {
            $this->step++;
        }
    }

    public function prevStep()
    {
        $this->step = max(1, $this->step - 1);
    }

    public function showToast($message)
    {
        $this->toastMessage = $message;
        $this->dispatch('show-toast');
    }

    public function submitForm()
    {
        $validateSecondStep = $this->validateStepTwo();

        if($validateSecondStep) {
            $dateOfBirth = $this->formData['dob_year'].'-'.$this->formData['dob_month'].'-'.$this->formData['dob_date'];

            if($this->formData['marital_status'] !== '') {

                if($this->formData['marital_status']) {
                    $dateOfMarriage = $this->formData['year_of_marriage'].'-'.$this->formData['month_of_marriage'].'-'.$this->formData['date_of_marriage'];
                    $ageAtMarriage =Carbon::createFromFormat('Y-m-d', $dateOfBirth)
                    ->diffInYears(Carbon::createFromFormat('Y-m-d', $dateOfMarriage));
    
                    if ($ageAtMarriage < 18) {
                        $this->showToast('You are not eligible to apply because your marriage occurred before your 18th birthday.');
                        return $this->addError('formData.notEligible',
                        'You are not eligible to apply because your marriage occurred before your 18th birthday.');
                    }
                }

                // Save form data into database using Eloquent
                $createEntry = LiveWireUserInfo::create([
                    'first_name' => $this->formData['first_name'],
                    'last_name' => $this->formData['last_name'],
                    'address' => $this->formData['address'],
                    'city' => $this->formData['city'],
                    'country' => $this->formData['country'],
                    'marital_status' => $this->formData['marital_status'],
                    'dob' => @$dateOfBirth,
                    'dom' => @$dateOfMarriage,
                    'country_of_marriage' => $this->formData['country_of_marriage'],
                    'is_widow' => $this->formData['is_widow'],
                    'is_previously_married' => $this->formData['previously_married'],
                ]);

                if($createEntry) {
                    $this->step++;
                }
            }
        }
    }

    protected $validationAttributes = [
        'formData.first_name' => 'First name',
        'formData.last_name' => 'Last name',
        'formData.address' => 'address',
        'formData.city' => 'city',
        'formData.country' => 'country',
        'formData.dob_month' => 'month',
        'formData.dob_date' => 'date',
        'formData.dob_year' => 'year',
        'formData.marital_status' => 'marital status',
        'formData.date_of_marriage' => 'marriage date',
        'formData.month_of_marriage' => 'marriage month',
        'formData.year_of_marriage' => 'marriage year',
        'formData.country_of_marriage' => 'marriage country',
        'formData.is_widow' => 'widow status',
        'formData.previously_married' => 'married previously'
    ];

    protected function validateStepOne()
    {
        $rules = [
            'formData.first_name' => 'required',
            'formData.last_name' => 'required',
            'formData.address' => 'required',
            'formData.city' => 'required',
            'formData.country' => 'required',
            'formData.dob_month' => 'required',
            'formData.dob_date' => 'required',
            'formData.dob_year' => 'required',
        ];
        return $this->validate($rules);
    }
    
    protected function validateStepTwo()
    {
        $rules = [
            'formData.marital_status' => 'required',
        ];
        if ($this->formData['marital_status'] == '1') {
            $rules['formData.month_of_marriage'] = 'required|integer|min:1|max:31';
            $rules['formData.date_of_marriage'] = 'required|integer|min:1|max:12';
            $rules['formData.year_of_marriage'] = 'required|integer|min:1900|max:' . (date('Y'));
            $rules['formData.country_of_marriage'] = 'required';
        }
        if ($this->formData['marital_status'] == '0') {
            $rules['formData.is_widow'] = 'required';
            $rules['formData.previously_married']= 'required';
        }
        return  $this->validate($rules);
    }
}