<?php
defined('BASEPATH') OR exit('No direct script access allowed');
defined('SHOW_DEBUG_BACKTRACE') OR define('SHOW_DEBUG_BACKTRACE', TRUE);
defined('FILE_READ_MODE')  OR define('FILE_READ_MODE', 0644);
defined('FILE_WRITE_MODE') OR define('FILE_WRITE_MODE', 0666);
defined('DIR_READ_MODE')   OR define('DIR_READ_MODE', 0755);
defined('DIR_WRITE_MODE')  OR define('DIR_WRITE_MODE', 0755);
defined('FOPEN_READ')                           OR define('FOPEN_READ', 'rb');
defined('FOPEN_READ_WRITE')                     OR define('FOPEN_READ_WRITE', 'r+b');
defined('FOPEN_WRITE_CREATE_DESTRUCTIVE')       OR define('FOPEN_WRITE_CREATE_DESTRUCTIVE', 'wb'); // truncates existing file data, use with care
defined('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE')  OR define('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE', 'w+b'); // truncates existing file data, use with care
defined('FOPEN_WRITE_CREATE')                   OR define('FOPEN_WRITE_CREATE', 'ab');
defined('FOPEN_READ_WRITE_CREATE')              OR define('FOPEN_READ_WRITE_CREATE', 'a+b');
defined('FOPEN_WRITE_CREATE_STRICT')            OR define('FOPEN_WRITE_CREATE_STRICT', 'xb');
defined('FOPEN_READ_WRITE_CREATE_STRICT')       OR define('FOPEN_READ_WRITE_CREATE_STRICT', 'x+b');
defined('EXIT_SUCCESS')        OR define('EXIT_SUCCESS', 0); // no errors
defined('EXIT_ERROR')          OR define('EXIT_ERROR', 1); // generic error
defined('EXIT_CONFIG')         OR define('EXIT_CONFIG', 3); // configuration error
defined('EXIT_UNKNOWN_FILE')   OR define('EXIT_UNKNOWN_FILE', 4); // file not found
defined('EXIT_UNKNOWN_CLASS')  OR define('EXIT_UNKNOWN_CLASS', 5); // unknown class
defined('EXIT_UNKNOWN_METHOD') OR define('EXIT_UNKNOWN_METHOD', 6); // unknown class member
defined('EXIT_USER_INPUT')     OR define('EXIT_USER_INPUT', 7); // invalid user input
defined('EXIT_DATABASE')       OR define('EXIT_DATABASE', 8); // database error
defined('EXIT__AUTO_MIN')      OR define('EXIT__AUTO_MIN', 9); // lowest automatically-assigned error code
defined('EXIT__AUTO_MAX')      OR define('EXIT__AUTO_MAX', 125); // highest automatically-assigned error code


define('DASHBOARD_JS',array(
    "vendor/global/global.min.js",
    "vendor/bootstrap-select/dist/js/bootstrap-select.min.js",
    "vendor/chart.js/Chart.bundle.min.js",
    "vendor/apexchart/apexchart.js",
    "js/dashboard/dashboard-1.js",
    "vendor/draggable/draggable.js",
    "vendor/swiper/js/swiper-bundle.min.js",
    "vendor/tagify/dist/tagify.js",
    "vendor/datatables/js/jquery.dataTables.min.js",
    "vendor/datatables/js/dataTables.buttons.min.js",
    "vendor/datatables/js/buttons.html5.min.js",
    "vendor/datatables/js/jszip.min.js",
    "js/plugins-init/datatables.init.js",
    "vendor/bootstrap-datetimepicker/js/moment.js",
    "vendor/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js",
    "vendor/jqvmap/js/jquery.vmap.min.js",
    "vendor/jqvmap/js/jquery.vmap.world.js",
    "vendor/jqvmap/js/jquery.vmap.usa.js",
    "js/custom.js",
    "js/deznav-init.js",
    "js/demo.js",
    "js/styleSwitcher.js"
));

define('DASHBOARD_CSS',array(
    "vendor/swiper/css/swiper-bundle.min.css",
	"cdnjs.cloudflare.com/ajax/libs/noUiSlider/14.6.4/nouislider.min.css",
	"vendor/datatables/css/jquery.dataTables.min.css",
	"vendor/jvmap/jquery-jvectormap.css",
	"cdn.datatables.net/buttons/1.6.4/css/buttons.dataTables.min.css",
	"vendor/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css",
	"vendor/bootstrap-select/dist/css/bootstrap-select.min.css",
	"css/style.css"
));

define('LOGIN_CSS',array(
    "vendor/swiper/css/swiper-bundle.min.css",
	"cdnjs.cloudflare.com/ajax/libs/noUiSlider/14.6.4/nouislider.min.css",
	"vendor/datatables/css/jquery.dataTables.min.css",
	"vendor/jvmap/jquery-jvectormap.css",
	"cdn.datatables.net/buttons/1.6.4/css/buttons.dataTables.min.css",
	"vendor/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css",
	"vendor/bootstrap-select/dist/css/bootstrap-select.min.css",
	"css/style.css"
));

define('LOGIN_JS',array(
    "vendor/global/global.min.js",
    "vendor/bootstrap-select/dist/js/bootstrap-select.min.js",
    "js/custom.js",
    "js/deznav-init.js",
    "js/demo.js",
));

define('TABLE_JS',array(
    "vendor/global/global.min.js",
    "vendor/bootstrap-select/dist/js/bootstrap-select.min.js",
    "js/custom.js",
    "js/deznav-init.js",
    "js/demo.js",
    "vendor/datatables/js/jquery.dataTables.min.js",
    "js/plugins-init/datatables.init.js",
    "vendor/moment/moment.min.js",
    "vendor/bootstrap-daterangepicker/daterangepicker.js",
    "vendor/clockpicker/js/bootstrap-clockpicker.min.js",
    "vendor/jquery-asColor/jquery-asColor.min.js",
    "vendor/jquery-asGradient/jquery-asGradient.min.js",
    "vendor/jquery-asColorPicker/js/jquery-asColorPicker.min.js",
    "vendor/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.js",
    "vendor/pickadate/picker.js",
    "vendor/pickadate/picker.time.js",
    "vendor/pickadate/picker.date.js",
    "js/plugins-init/bs-daterange-picker-init.js",
    "js/plugins-init/clock-picker-init.js",
    "js/plugins-init/jquery-asColorPicker.init.js",
    "js/plugins-init/material-date-picker-init.js",
    "js/plugins-init/pickadate-init.js",
    // "/vendor/moment/moment.min.js",
    // "vendor/bootstrap-daterangepicker/daterangepicker.js",
    // "vendor/clockpicker/js/bootstrap-clockpicker.min.js",
    // "vendor/jquery-asColor/jquery-asColor.min.js",
    // "vendor/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.js",
    "js/pdfmake.min.js",
    "js/vfs_fonts.js",
    "js/buttons.html5.min.js",
    "js/buttons.print.min.js",
    "datatable/datatable-extension/dataTables.responsive.min.js",
    "datatable/datatable-extension/dataTables.fixedHeader.min.js",
    "datatable/datatable-extension/dataTables.buttons.min.js",
    "js/buttons.flash.min.js",
    "js/jszip.min.js"

));

define('TABLE_CSS',array(
    "vendor/swiper/css/swiper-bundle.min.css",
	"cdnjs.cloudflare.com/ajax/libs/noUiSlider/14.6.4/nouislider.min.css",
	"vendor/datatables/css/jquery.dataTables.min.css",
	"vendor/jvmap/jquery-jvectormap.css",
	"cdn.datatables.net/buttons/1.6.4/css/buttons.dataTables.min.css",
	"vendor/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css",
	"vendor/bootstrap-select/dist/css/bootstrap-select.min.css",
	"css/style.css",
    "vendor/bootstrap-daterangepicker/daterangepicker.css",
    "vendor/clockpicker/css/bootstrap-clockpicker.min.css",
    "vendor/jquery-asColorPicker/css/asColorPicker.min.css",
    "vendor/bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.css",
    "vendor/pickadate/themes/default.css",
    "vendor/pickadate/themes/default.date.css",
    "fixedHeader.bootstrap.min.css",
    "responsive.bootstrap.min.css",
    "buttons.dataTables.min.css",
));

