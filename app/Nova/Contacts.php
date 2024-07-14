<?php

namespace App\Nova;

use Illuminate\Http\Request;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\Email;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Textarea;
use Laravel\Nova\Http\Requests\NovaRequest;
use Pktharindu\NovaPermissions\Checkboxes;

class Contacts extends Resource
{
    public static function label()
    {
        return 'العملاء ';
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
     * @var class-string<\App\Models\Contacts>
     */
    public static $model = \App\Models\Contacts::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'title';

    public function title()
    {
        return $this->Phone . '-' . $this->IdNumber;
    }

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'Name',
        'IdNumber',
        'Phone'
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
            BelongsTo::make('نوع العميل', 'ContactType', ContactTypes::class)->rules('required')->sortable()->filterable(),
            Text::make('الاسم', 'Name')->rules('required'),
            Number::make('رقم الجوال', 'Phone')->rules('required'),
            BelongsTo::make('الجنسية', 'Nationality', Nationalities::class)->rules('required')->default('1'),
            BelongsTo::make('المدينة', 'City', Cities::class)->rules('required')->default('1')->filterable(),
            Textarea::make('الملاحظات', 'Note'),
            Boolean::make('القائمة السوداء', 'BlackList')->hideFromIndex()
                ->trueValue('نعم')
                ->falseValue('لا')
                ->rules('required')->default(false)->filterable(),
            Number::make('رقم الهوية الوطنية', 'IdNumber')->rules('required'),
            Email::make('البريد الاكتروني', 'Email'),
            Date::make('تاريخ الميلاد', 'BirthDate')->rules('required'),
            Text::make('العمر', function () {
                if ($this->BirthDate) {
                    $birthDate = new \DateTime($this->BirthDate);
                    $currentDate = new \DateTime();
                    $age = $currentDate->diff($birthDate)->y;
                    return $age . ' سنة';
                }
                return 'N/A';
            })->exceptOnForms(),

            Select::make('العنوان', 'Address')
                ->options([
                    'الرياض' => 'الرياض',
                ]),


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
