<?php

namespace App\Nova;

use Illuminate\Http\Request;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\FormData;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;
use Armincms\Wizard\Step;

class Workers extends Resource
{

    public static function label()
    {
        return 'السير الذانية للاستقدام ';
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
     * @var class-string<\App\Models\Workers>
     */
    public static $model = \App\Models\Workers::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'Passport';

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
            Text::make('الاسم', 'Name'),
            BelongsTo::make('الديانة', 'Religions', Religions::class)->rules('required')->default('1'),
            BelongsTo::make('المهنة', 'Jobs', Jobs::class)->rules('required')->default('1')->sortable()->searchable(),
            BelongsTo::make('الجنسية', 'Nationality', Nationalities::class)
                ->rules('required')->default('17')
                ->sortable()->searchable(),

            Select::make('الوكيل', 'AgentId')
                ->options(function (NovaRequest $request) {
                    // Fetch agents based on the default nationality (if any)
                    $nationalityId = $request->input('Nationality', 1); // Default to 1 if NationalityId is not set
                    return \App\Models\Agents::where('NationalityId', $nationalityId)->pluck('name', 'id');
                })
                ->rules('required')
                ->dependsOn(['Nationality'], function (Select $field, NovaRequest $request, FormData $formData) {
                    $nationalityId = $formData->Nationality ?? $request->input('Nationality', 1);
                    $options = \App\Models\Agents::where('NationalityId', $nationalityId)->pluck('name', 'id')->toArray();
                    $field->options($options);
                })
                ->displayUsingLabels()
                ->hideFromIndex()
                ->onlyOnForms()->sortable()->searchable(),
            Text::make('الوكيل', function () {
                return $this->Agents->Name;
            })->sortable(),
//            Number::make('سعر الاستقدام', 'AgentCost'),
            Text::make('سعر الاستقدام', function () {
                // Assuming 'AgentCost' is a property on the Agents model
                return isset($this->Agents) ? $this->Agents->AgentCost : '';
            }),
            Date::make('تاريخ الميلاد', 'BirthDate')->rules('required'),
            Number::make('العمر', 'Age'),
            Boolean::make('سبق لها العمل', 'Experience')->default(false),
            Number::make('سنوات الخبرة', 'ExpYears2'),
            Number::make('الراتب', 'Salary'),


            Text::make('رقم الجواز', 'Passport')->rules('required'),


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
