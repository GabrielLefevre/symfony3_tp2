<?php
/**
 * Created by PhpStorm.
 * User: DEV2
 * Date: 22/03/2017
 * Time: 13:59
 */

namespace ReservationBundle;


class GlobalEvents
{
    const PERIOD_ADD = 'app.event.period.add';
    const PERIOD_EDIT = 'app.event.period.edit';
    const PERIOD_DELETE = 'app.event.period.delete';

    const SEASON_ADD = 'app.event.season.add';
    const SEASON_EDIT = 'app.event.season.edit';
    const SEASON_DELETE = 'app.event.season.delete';

    const PACKAGE_ADD = 'app.event.package.add';
    const PACKAGE_EDIT = 'app.event.package.edit';
    const PACKAGE_DELETE = 'app.event.package.delete';

    const BOOKING_ADD = 'app.event.package.add';
    const BOOKING_EDIT = 'app.event.package.edit';
    const BOOKING_DELETE = 'app.event.package.delete';

}