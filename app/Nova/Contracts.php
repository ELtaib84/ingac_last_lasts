<?php

namespace App\Nova;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\FormData;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\Textarea;
use Laravel\Nova\Fields\Currency;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Panel;
use Alkoumi\LaravelArabicNumbers\Numbers;

class Contracts extends Resource
{
    public static function label()
    {
        return 'عقود الاستقدام ';
    }

    public static function authorizedToViewAny($request)
    {
        return true;
    }

    public function authorizedToView(Request $request)
    {
        return true;
    }

    public function authorizedToUpdate(Request $request)
    {
        return true;
    }

    public function authorizedToDelete(Request $request)
    {
        return true;
    }

    public static function authorizedToCreate(Request $request)
    {
        return true;
    }

    /**
     * The model the resource corresponds to.
     *
     * @var class-string<\App\Models\Contracts>
     */
    public static $model = \App\Models\Contracts::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'id';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'id',
    ];

    /**
     * Get the fields displayed by the resource.
     *
     * @param \Laravel\Nova\Http\Requests\NovaRequest $request
     * @return array
     */
    public function fields(NovaRequest $request)
    {
        return [
            ID::make()->sortable(),
            Panel::make('العقد', [
                Text::make('رقم العقد', 'ContractCode'),
                BelongsTo::make('نوع العقد', 'ContractTypes', ContractTypes::class),
                Date::make('تاريخ العقد', 'ContractDate'),
                Date::make('تاريخ نهاية العقد', 'ContractEndDate'),
                Number::make('مدة العقد', 'ContractDays'),
                Text::make('رقم عقد مساند', 'FileNumber'),
                Text::make('رقم التأشيرة', 'VisaNo'),
                BelongsTo::make('نوع التاشيرة', 'VisaTypes', VisaTypes::class),
                BelongsTo::make('جهة القدوم', 'Cities', Cities::class),
                BelongsTo::make('مطار الوصول', 'Airports', Airports::class),


//            Date::make('تاريخ التأشيرة', 'VisaDate'),
            ]),

            Panel::make('العميل ', [
                BelongsTo::make('الجوال / الهوية', 'Contacts', Contacts::class),
                Text::make('اسم العميل ', function () {
                    return $this->Contacts->Name;
                }),
                Text::make('رقم العميل ', function () {
                    return $this->Contacts->Phone;
                }),
                Text::make('الهوية الوطنية  ', function () {
                    return $this->Contacts->IdNumber;
                }),
                Text::make('العنوان', function () {
                    return $this->Contacts->Address;
                }),
                Text::make('تاريخ الميلاد', function () {
                    return Carbon::parse($this->Contacts->BirthDate)->format('d-m-Y');
                }),
                Text::make('البنك', 'Bank')->hideFromIndex()->rules('required'),
                Text::make('رقم الايبان', 'IBAN')->hideFromIndex()->rules('required'),

            ]),
            Panel::make('العاملة ', [
                BelongsTo::make('رقم جواز العاملة', 'Workers', Workers::class)->searchable(),

                Text::make('اسم العامل ')->dependsOn(['Workers'], function (Text $field, NovaRequest $request, FormData $formData) {

                        $id = $formData->Workers ?? $this->Workers;
                        $name = \App\Models\Workers::where('id', $id)->value('Name');

                        $field->value = $name;
                    })->readonly(),
                Text::make('العمر ')->dependsOn(['Workers'], function (Text $field, NovaRequest $request, FormData $formData) {

                        $id = $formData->Workers ?? $this->Workers;
                        $BirthDate = \App\Models\Workers::where('id', $id)->value('BirthDate');

                        $field->value = Carbon::parse($BirthDate)->age;
                    })->readonly(),
                Text::make('الجنسية ')->dependsOn(['Workers'], function (Text $field, NovaRequest $request, FormData $formData) {

                        $id = $formData->Workers ?? $this->Workers;
                        $Nationality = \App\Models\Workers::where('id', $id)->value('NationalityId');
                        $Nationality = \App\Models\Nationalities::where('id', $Nationality)->value('Name');


                        $field->value = $Nationality;
                    })->readonly(),

                Text::make('الجنسية  ', function () {
                    return $this->Workers->Nationality->Name;
                }),
                Text::make('المهنة', function () {
                    return $this->Workers->Jobs->Name;
                }),
                Text::make('الوكيل', function () {
                    return $this->Workers->Agents->Name;
                }),


            ]),
            Panel::make('المالية', [
                Currency::make('الاجمالي', 'Amount'),

                Currency::make('تذكرة داخلية', 'Addition'),

                Currency::make('الضربية', 'Tax', function () {
                    return floatval(($this->Amount + $this->Addition) * 0.15);
                })
                    ->dependsOn(['Addition', 'Amount'], function (Currency $field, NovaRequest $request, FormData $formData) {
                        $amount = floatval($formData->Amount ?? $this->Amount);
                        $addition = floatval ($formData->Addition ?? $this->Addition);
                        $total = (($amount + $addition) * 0.15);
                        $field->value = $total;

                    })->readonly(),


                Currency::make('تكاليف بنكية', 'BankCost')->default('0.00'),

                Currency::make('صافي المبلغ', 'Total', function () {
                    return floatval($this->Amount + (($this->Amount + $this->Addition) * 0.15) + $this->BankCost);
                })
                    ->dependsOn(['Amount', 'Addition', 'BankCost'], function (Currency $field, NovaRequest $request, FormData $formData) {
                        $amount = floatval($formData->Amount ?? $this->Amount);
                        $addition = floatval($formData->Addition ?? $this->Addition);
                        $bankCost = floatval($formData->BankCost ?? $this->BankCost);

                        $total = $amount + (($amount + $addition) * 0.15) + $bankCost + $addition;
                        $field->value = $total;
                    }),
                Currency::make('قيمة الحجر المؤسسي' , 'RentAlert')->default('0.00'),
                Text::make('المبلغ بالعربي ','AmountArabic')->dependsOn(['Total'], function (Text $field, NovaRequest $request, FormData $formData) {
                    $Total = floatval($formData->Total ?? $this->Total);
                    $AmountArabic = Numbers::TafqeetMoney($Total);
                    $field->value = $AmountArabic;

                })->readonly(),
                BelongsTo::make('مدينة الاستلام', 'Cities_Delivery', Cities::class)->rules('required'),

            ]),


            Textarea::make('Notes')->nullable(),
            Text::make('Attach File')->nullable(),
            Boolean::make('Paid')->default(false),
            Text::make('Bank')->nullable(),
            Text::make('IBAN')->nullable(),
            BelongsTo::make('Insert User', 'User', User::class),
            Number::make('Period Days')->nullable(),
            Number::make('Contract Period')->nullable(),
            Boolean::make('Is Deleted')->default(false),
            Text::make('Amount Arabic')->nullable(),
            Boolean::make('Sales Approval')->default(false),
            Boolean::make('Finance Approval')->default(false),
            Boolean::make('Tarjama Approval')->default(false),
            Boolean::make('Delegate Approval')->default(false),
            Textarea::make('Assign Notes')->nullable(),
//            BelongsTo::make('Assign To', 'assignTo', User::class),
            Textarea::make('Signature')->nullable(),
            Boolean::make('Need Replace')->default(false),
            BelongsTo::make('Old Worker', 'OldWorker', Workers::class),
            Boolean::make('Is Called')->default(false),
            Text::make('To Called By', 'ToCalledBy', function () {
                $name = \App\Models\User::where('id', $this->ToCalledBy)->first();
                return $name;
            }),
            Date::make('Arrive Date')->nullable(),
            Boolean::make('Worker Arrived')->default(false),
            Date::make('Delivery Date')->nullable(),
            Boolean::make('Worker Delivered')->default(false),
            Boolean::make('Is Closed')->default(false),
            Text::make('Air Ticket')->nullable(),
            Text::make('To Delivered By', 'ToDeliveredBy', function () {
                $name = \App\Models\User::where('id', $this->ToDeliveredBy)->first();
                return $name;

            }),
            Text::make('Delete Reason')->nullable(),
            Boolean::make('Is Quarantine Paid')->default(false),
            Text::make('Arrive Days')->nullable(),
        ];
    }

    /**
     * Get the cards available for the request.
     *
     * @param \Laravel\Nova\Http\Requests\NovaRequest $request
     * @return array
     */
    public function cards(NovaRequest $request)
    {
        return [];
    }

    /**
     * Get the filters available for the resource.
     *
     * @param \Laravel\Nova\Http\Requests\NovaRequest $request
     * @return array
     */
    public function filters(NovaRequest $request)
    {
        return [];
    }

    /**
     * Get the lenses available for the resource.
     *
     * @param \Laravel\Nova\Http\Requests\NovaRequest $request
     * @return array
     */
    public function lenses(NovaRequest $request)
    {
        return [];
    }

    /**
     * Get the actions available for the resource.
     *
     * @param \Laravel\Nova\Http\Requests\NovaRequest $request
     * @return array
     */
    public function actions(NovaRequest $request)
    {
        return [];
    }
}
