<?php

namespace Finoux\DB\traits;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;

trait ValidationTrait
{
    public  $validator = [];

    public $rules = [
        'driving_license_number' => [
            'rules' => [
                'required', 'string', 'min:15', 'max:20'
            ],
            'messages' => [],
        ],
        'dob' => [
            'rules' => [
                // 'bail',
                'required',
                'date'
            ],
            'messages' => [],
        ],
        'pan' => [
            'rules' => [
                // 'bail',
                'required',
                'alpha_num',
                'min:10',
                'max:10',
                'regex:/^([a-zA-Z]){5}([0-9]){4}([a-zA-Z]){1}?$/',
            ],
            'messages' => [
                'regex' => "Invalid PAN Number"
            ]
        ],
        'required' => [
            'rules' => [
                'required'
            ],
            'messages' => [
                'required' => ':attribute is required'
            ]
        ],
        'email' => [
            'rules' => [
                'bail',
                'required',
                'regex:/^(?!(?:(?:\x22?\x5C[\x00-\x7E]\x22?)|(?:\x22?[^\x5C\x22]\x22?)){255,})(?!(?:(?:\x22?\x5C[\x00-\x7E]\x22?)|(?:\x22?[^\x5C\x22]\x22?)){65,}@)(?:(?:[\x21\x23-\x27\x2A\x2B\x2D\x2F-\x39\x3D\x3F\x5E-\x7E]+)|(?:\x22(?:[\x01-\x08\x0B\x0C\x0E-\x1F\x21\x23-\x5B\x5D-\x7F]|(?:\x5C[\x00-\x7F]))*\x22))(?:\.(?:(?:[\x21\x23-\x27\x2A\x2B\x2D\x2F-\x39\x3D\x3F\x5E-\x7E]+)|(?:\x22(?:[\x01-\x08\x0B\x0C\x0E-\x1F\x21\x23-\x5B\x5D-\x7F]|(?:\x5C[\x00-\x7F]))*\x22)))*@(?:(?:(?!.*[^.]{64,})(?:(?:(?:xn--)?[a-z0-9]+(?:-[a-z0-9]+)*\.){1,126}){1,}(?:(?:[a-z][a-z0-9]*)|(?:(?:xn--)[a-z0-9]+))(?:-[a-z0-9]+)*)|(?:\[(?:(?:IPv6:(?:(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){7})|(?:(?!(?:.*[a-f0-9][:\]]){7,})(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,5})?::(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,5})?)))|(?:(?:IPv6:(?:(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){5}:)|(?:(?!(?:.*[a-f0-9]:){5,})(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,3})?::(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,3}:)?)))?(?:(?:25[0-5])|(?:2[0-4][0-9])|(?:1[0-9]{2})|(?:[1-9]?[0-9]))(?:\.(?:(?:25[0-5])|(?:2[0-4][0-9])|(?:1[0-9]{2})|(?:[1-9]?[0-9]))){3}))\]))$/'
            ],
            'messages' => [
                'regex' => "Invalid Email Address"
            ]
        ],
        'aadhar' => [
            'rules' => [

                'required',
                'regex:/^\d{4}\s*\d{4}\s*\d{4}$/'
            ],
            'messages' => [
                'regex' => "Invalid Aadhar Number"
            ]
        ],
        'voter' => [
            'rules' => [
                'required',
                'regex:/^([a-zA-Z]){3}([0-9]){7}?$/'
            ],
            'messages' => [
                'regex' => "Invalid voter ID Number"
            ]
        ],
        'ifsc' => [
            'rules' => [
                'required',
                'regex:/[A-Z,a-z]{4}[0][\d]{6}$/'
            ],
            'messages' => [
                'regex' => "Invalid IFSC Code"
            ]
        ],
        'mobile' => [
            'rules' => [
                'required',
                'regex:/\+?\d[\d -]{8,12}\d/',
                'max:12'
            ],
            'messages' => [
                'regex' => "Invalid Mobile Number",
                'max' => "Enter Value should be maximum 12"
            ]
        ],
        'driving_lic'  => [
            'rules' => [
                'required',
                'regex:/^[a-zA-Z]{2}\d{2}+\s*\d{8,10}$/'
            ],
            'messages' => [
                'regex' => "Invalid Driving Licence Number"
            ]
        ],
        'passport'  => [
            'rules' => [
                'required',
                'regex:/^[a-zA-Z]{2}\d{2}+\s*\d{8,10}$/'
            ],
            'messages' => [
                'regex' => "Invalid Driving Licence Number"
            ]
        ],
        'StrongPassword'  => [
            'rules' => [
                'required',
                "regex:/^\S*(?=\S{8,})(?=\S*[a-z])(?=\S*[A-Z])(?=\S*[\d])\S*$/"
            ],
            'messages' => [
                'regex' => "The password must be 8 characters, and include a number, a symbol, a lower and a upper case letter"
            ]
        ],
        'numeric' =>  [
            'rules' => [
                'required',
                'numeric'
            ],
            'messages' => [
                'numeric' => "Only Number allowed"
            ]
        ],
        'alphabates' =>  [
            'rules' => [
                'required',
                'alpha'
            ],
            'messages' => [
                'alpha' => "Only Alphabates allowed"
            ]
        ],
        'alpha_dash' =>  [
            'rules' => [
                'required',
                'alpha_dash'
            ],
            'messages' => [
                'alpha_dash' => "Only Alphabates, Dash and Underscore allow"
            ]
        ],
        'amount' =>  [
            'rules' => [
                'required',
                'regex:/^\d+(\.\d{1,})?$/'
            ],
            'messages' => [
                'regex' => "Invalid Amount"
            ]
        ],
        'domain' => [
            'rules' => [
                'required',
                'regex:/(?:[a-z0-9](?:[a-z0-9-]{0,61}[a-z0-9])?\.)+[a-z0-9][a-z0-9-]{0,61}[a-z0-9]/'
            ],
            'messages' => [
                'regex' => 'Invalid domain'
            ]
        ],
        'MacAddress' => [
            'rules' => [
                'required',
                'regex:/^([0-9A-Fa-f]{2}[:-]){5}([0-9A-Fa-f]{2})$/'
            ],
            'messages' => [
                'regex' => 'Invalid MAC Address'
            ]
        ],
        'required' => [
            'rules' => [
                'required',
            ],
            'messages' => []
        ],
        'min' => [
            'rules' => [
                'required',
                'min:'
            ],
            'messages' => [
                'min' => 'Enter value should be minimum '
            ]
        ],
        'max' => [
            'rules' => [
                'required',
                'max:'
            ],
            'messages' => [
                'max' => 'Enter Value should be maximum '
            ]
        ],
        'accepted' => [
            'rules' => [
                'accepted'
            ],
            'messages' => [
                'accepted' => 'Your have to read and agree the terms and conditions'
            ]
        ],
        'afterdate' => [
            'rules' => [
                'required',
                'date',
                'after:' // tommorow,today,yesterday or strtotime 
            ],
            'messages' => [
                'after' => 'Invalid date '
            ]
        ],
        'after_or_equal_date' => [
            'rules' => [
                'required',
                'date',
                'after_or_equal:' // tommorow,today,yesterday or strtotime 
            ],
            'messages' => [
                'after_or_equal' => 'Invalid date '
            ]
        ],
        'beforedate' => [
            'rules' => [
                'required',
                'date',
                'after:' // tommorow,today,yesterday or strtotime 
            ],
            'messages' => [
                'after' => 'Invalid date '
            ]
        ],
        'before_or_equal_date' => [
            'rules' => [
                'required',
                'date',
                'after_or_equal:' // tommorow,today,yesterday or strtotime 
            ],
            'messages' => [
                'after_or_equal' => 'Invalid date '
            ]
        ],
        'minmax' => [
            'rules' => [
                'required',
                'min:',
                'max:'
            ],
            'messages' => [
                'min' => 'Enter Value should be minimum ',
                'max' => 'Enter Value should be maximum '
            ]
        ],
        'captcha' => [
            'rules' => [
                'required',
                'captcha'
            ],
            'messages' => [
                'captcha' => "Invalid Captcha"
            ]
        ],
      

    ];

    public  function testValidator($inputs, $rules = null, $messages = null)
    {

        // dd($inputs, $rules, $messages);
        return Validator::make($inputs, $rules, $messages);
    }

    /**
     *  rule: driving_license_number,dob,pan,mobile,email
     * 
     */
    public function do_arrvalidate($input = [], $rules = [], $messages = [], $mandatory = [])
    {


        // $input = [
        //     'user_consent' => '',
        //     'pan_number' => ''
        // ];
        // $rules = [
        //     'user_consent' => 'accepted',
        //     'pan_number' => 'pan',
        // ];
        // $messages = [
        //     // 'user_consent.accepted' => ' is required',
        //     'pan_number.regex' => ''
        // ];

        $tempRules = [];
        $tempMessages = [];
        $rulesString = [];
        foreach ($rules as $key => $value) {
            $tempRules[$key] =  Arr::exists($this->rules, $value) ? $this->rules[$value]['rules'] : $value;
            $tempMessages[$key] = Arr::exists($this->rules, $value) ? $this->rules[$value]['messages'] : [];
            $needArrayConvert = true;
            if(is_array($tempRules[$key])){
                if(count($tempRules[$key]) > 0){
                    foreach ($tempRules[$key] as $k => $val) {
                        if(Str::contains($val,"regex")){
                            if(Str::contains($val,"|")){
                              $needArrayConvert = false;
                            }
                        }
                    }
                    
                }
            }
           
            if($needArrayConvert){
                $rulesString[$key] = is_array($tempRules[$key]) ? implode('|', $tempRules[$key]) : $tempRules[$key];
            }else{
                $rulesString[$key] = $tempRules[$key];
            }
        }

        // ['VARIABLE_NAME'=> ['RULE'=> "MESSAGE"]]
        // dd($messages);
        foreach ($messages as $key => $value) {
            Arr::set($tempMessages, $key, $value);
        }
        // dd($input,$rulesString, Arr::dot($tempMessages));
        // dd(implode('|',$customRules['pan_number']));

        $this->validator = $this->testValidator($input, $rulesString, Arr::dot($tempMessages));
    }



    public function do_validate($input, $type = null, $others = [], $mandatory = true)
    {

        $is_valid = true;
        $value = [$type => $input];
        if ($mandatory && !empty($value)) {
            foreach ($others['messages'] as $key => $value) {
                $this->rules[$type]['messages'][$key] = $value;
            }

            switch ($type) {

                case 'selectatleast':
                    $this->validator = $this->testValidator($input, [$type => $others['regex']], $others['messages']);
                    if ($this->validator->fails()) {
                        $is_valid = false;
                    }
                    break;

                    break;

                case 'custom':
                    /**
                     * regex rules separated by |  
                     * 
                     */
                    $this->validator = $this->testValidator($value, [$type => $others['rules']], $others['messages']);
                    if ($this->validator->fails()) {
                        $is_valid = false;
                    }
                    break;

                case 'min':
                    $this->rules[$type]['rules'][1] = $this->rules[$type]['rules'][1] . $others['min'];
                    $this->rules[$type]['messages']['min'] =     $this->rules[$type]['messages']['min'] . $others['min'];
                    $this->validator = $this->testValidator($value, [$type =>  $this->rules[$type]['rules']], $this->rules[$type]['messages']);

                    if ($this->validator->fails()) {
                        $is_valid = false;
                    }
                    break;

                case 'afterdate':
                    $this->rules[$type]['rules'][1] = $this->rules[$type]['rules'][1] . $others['afterdate'];
                    $this->validator = $this->testValidator($value, [$type =>  $this->rules[$type]['rules']], $this->rules[$type]['messages']);

                    if ($this->validator->fails()) {
                        $is_valid = false;
                    }
                    break;


                case 'max':
                    $this->rules[$type]['rules'][1] = $this->rules[$type]['rules'][1] . $others['max'];
                    $this->rules[$type]['messages']['max'] =     $this->rules[$type]['messages']['max'] . $others['max'];
                    $this->validator = $this->testValidator($value, [$type =>  $this->rules[$type]['rules']], $this->rules[$type]['messages']);

                    if ($this->validator->fails()) {
                        $is_valid = false;
                    }
                    break;

                case 'minmax':
                    $this->rules[$type]['rules'][1] = $this->rules[$type]['rules'][1] . $others['min'];
                    $this->rules[$type]['rules'][2] = $this->rules[$type]['rules'][2] . $others['max'];
                    $this->rules[$type]['messages']['max'] =     $this->rules[$type]['messages']['max'] . $others['max'];
                    $this->rules[$type]['messages']['min'] =     $this->rules[$type]['messages']['min'] . $others['min'];
                    $this->validator = $this->testValidator($value, [$type =>  $this->rules[$type]['rules']], $this->rules[$type]['messages']);

                    if ($this->validator->fails()) {
                        $is_valid = false;
                    }
                    break;

                default:
                    $this->validator = $this->testValidator($value, [$type => $this->rules[$type]['rules']], $this->rules[$type]['messages']);
                    if ($this->validator->fails()) {
                        $is_valid = false;
                    }
                    break;
            }

            return $is_valid;
        } else {
            return true;
        }
    }
}
