<?php

namespace App\Nova;

use Alexwenzel\DependencyContainer\DependencyContainer;
use Alexwenzel\DependencyContainer\HasDependencies;
use Alexwenzel\DependencyContainer\ActionHasDependencies;
use Faker\Core\DateTime;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;
use function PHPUnit\Framework\isEmpty;

class Tickets extends Resource
{
    public static function label()
    {
        return 'طلبات الاستقدام ';
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
     * @var class-string<\App\Models\Tickets>
     */
    public static $model = \App\Models\Tickets::class;

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
            ID::make('رقم الطلب ' ,'id')->sortable()->readonly(),
            Date::make('تاريخ الطلب', 'TicketDate', function () {
                return now();
            })->readonly(),
            BelongsTo::make('الحالة', 'TicketStatus',TicketStatus::class )->rules('required')->default('1'),
            Text::make('رقم التأشيرة', 'VisaNo'),
            BelongsTo::make('نوع التأشيرة', 'VisaTypes', VisaTypes::class)->default('1'),
            BelongsTo::make('الجوال / الهوية', 'Contacts', Contacts::class)->rules('required')->searchable(),
            Text::make('اسم العميل' , function (){
                return $this->Contacts->Name;
            }),
            Text::make(' رقم الهوية' , function (){
                return $this->Contacts->IdNumber;
            }),

            Text::make(' نوع العميل  ' , function (){
                return $this->Contacts->ContactType->Name;
            }),

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
