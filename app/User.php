<?php

namespace App;

use App\Models\Department;
use App\Models\EmployementDetails;
use App\Models\Experience;
use App\Models\ProfessionalQualification;
use App\Models\Promotion;
use App\Models\Qualification;
use App\Models\ResultHistory;
use App\Models\TeachingDetail;
use App\Models\Training;
use App\Models\Transfer;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Spatie\Activitylog\Traits\LogsActivity;


class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable, LogsActivity;



    public static function districts()
    {
        return $districts = [
            'AJK' =>
                ['Muzaffarabad',
                    'Hattian Bala',
                    'Neelum',
                    'Mirpur',
                    'Bhimber',
                    'Kotli',
                    'Poonch',
                    'Bagh',
                    'Haveli',
                    'Sudhnati',
                ],
            'Balochistan' =>
                ['Awaran',
                    'Barkhan',
                    'Chagai',
                    'Dera Bugti',
                    'Gwadar',
                    'Harnai',
                    'Jafarabad',
                    'Jhal Magsi',
                    'Kachhi',
                    'Kalat',
                    'Kech',
                    'Kharan',
                    'Khuzdar',
                    'Killa Abdullah',
                    'Killa Saifullah',
                    'Kohlu',
                    'Lasbela',
                    'Lehri',
                    'Loralai',
                    'Mastung',
                    'Musakhel',
                    'Nasirabad',
                    'Nushki[18]',
                    'Panjgur',
                    'Pishin',
                    'Quetta',
                    'Sherani',
                    'Sibi',
                    'Sohbatpur',
                    'Washuk',
                    'Zhob',
                    'Ziarat',
                    'Duki',
                ],
            'Gilgit Baltistan' =>
                ['Ghanche',
                    'Skardu',
                    'Astore',
                    'Diamer',
                    'Ghizer',
                    'Gilgit',
                    'Hunza',
                    'Kharmang',
                    'Shigar',
                    'Nagar',
                    'Gupis–Yasin',
                    'Tangir',
                    'Darel',
                    'Roundu',
                ],
            'KPK' =>
                ['Abbottabad',
                    'Bajaur',
                    'Bannu',
                    'Battagram',
                    'Buner',
                    'Charsadda',
                    'Chitral',
                    'Dera Ismail Khan',
                    'Hangu',
                    'Haripur',
                    'Karak',
                    'Khyber',
                    'Kohat',
                    'Kurram',
                    'Lakki Marwat',
                    'Lower Dir',
                    'Lower Kohistan',
                    'Malakand',
                    'Mansehra',
                    'Mardan',
                    'Mohmand',
                    'North Waziristan',
                    'Nowshera',
                    'Orakzai',
                    'Peshawar',
                    'Shangla',
                    'South Waziristan',
                    'Swabi',
                    'Swat',
                    'Tank',
                    'Torghar',
                    'Upper Dir',
                    'Upper Kohistan',
                ],
            'Punjab' =>
                ['Attock',
                    'Bahawalnagar',
                    'Bahawalpur',
                    'Bhakkar',
                    'Chakwal',
                    'Chiniot',
                    'Dera Ghazi Khan',
                    'Faisalabad',
                    'Gujranwala',
                    'Gujrat',
                    'Hafizabad',
                    'Jhang',
                    'Jhelum',
                    'Kasur',
                    'Khanewal',
                    'Khushab',
                    'Lahore',
                    'Layyah',
                    'Lodhran',
                    'Mandi Bahauddin',
                    'Mianwali',
                    'Multan',
                    'Muzaffargarh',
                    'Narowal',
                    'Nankana Sahib[5]',
                    'Okara',
                    'Pakpattan',
                    'Rahim Yar Khan',
                    'Rajanpur',
                    'Rawalpindi',
                    'Sahiwal',
                    'Sargodha',
                    'Sheikhupura',
                    'Sialkot',
                    'Toba Tek Singh',
                    'Vehari',
                ],
            'Sindh' =>
                ['Badin',
                    'Dadu',
                    'Ghotki',
                    'Hyderabad',
                    'Jacobabad',
                    'Jamshoro',
                    'Karachi Central',
                    'Karachi East',
                    'Karachi South',
                    'Karachi West',
                    'Kashmore',
                    'Khairpur',
                    'Korangi',
                    'Larkana',
                    'Malir',
                    'Matiari',
                    'Mirpur Khas',
                    'Naushahro Feroze',
                    'Qambar Shahdadkot',
                    'Sanghar',
                    'Shaheed Benazir Abad',
                    'Shikarpur',
                    'Sujawal',
                    'Sukkur',
                    'Tando Allahyar',
                    'Tando Muhammad Khan',
                    'Tharparkar',
                    'Thatta',
                    'Umerkot'],
        ];
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     *
     */
    protected $fillable = [
        'email', 'password', 'dep_id',
        'cnic', 'first_name', 'middle_name', 'last_name', 'father_first_name', 'father_middle_name',
        'father_last_name', 'gender', 'marital_status', 'refugee_status', 'birth_place', 'birth_date',
        'province_domicile', 'district_domicile', 'current_address', 'permanent_address', 'image',
        'active', 'residential_phone', 'office_phone', 'mobile_phone', 'fax_number', 'emis_code',
        'usertype', 'verified', 'emp_type','designation','personal_no','verified_by'
    ];

    protected static $logAttributes = ['*'];
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function department()
    {
        return $this->belongsTo(Department::class, 'dep_id');
    }

    public function EmployementDetails()
    {
        return $this->hasMany(EmployementDetails::class, 'employee_id');
    }

    public function qualification()
    {
        return $this->hasMany(Qualification::class, 'employee_id');
    }

    //relation with professional qualification
    public function professional_qualification()
    {
        return $this->hasMany(ProfessionalQualification::class, 'employee_id');
    }

    //relation with experiences
    public function experience()
    {
        return $this->hasMany(Experience::class, 'employee_id');
    }

    //relation with trainings
    public function trainings()
    {
        return $this->hasMany(Training::class, 'employee_id');
    }

    //relation with transfers
    public function transfer()
    {
        return $this->hasMany(Transfer::class, 'employee_id');
    }

    //relation with teaching details
    public function teaching_details()
    {
        return $this->hasMany(TeachingDetail::class, 'employee_id');
    }

    //relation with teaching details
    public function result_history()
    {
        return $this->hasMany(ResultHistory::class, 'employee_id');
    }

    //relation with promotion
    public function promotion()
    {
        return $this->hasMany(Promotion::class, 'employee_id');
    }

    public static function hasAccess($employee)
    {
        if (Auth::user()->usertype == 'user' && Auth::user()->id != $employee->id) {
            return false;
        } elseif (Auth()->user()->usertype == "department_admin" && Auth::user()->dep_id != $employee->dep_id) {
            return false;
        }
        return true;
    }


}
