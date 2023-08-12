let mix = require('laravel-mix');

mix.scripts([
    "resources/assets/vendors/base/vendor.bundle.base.js",
    "resources/assets/vendors/chart.js/Chart.min.js",
    "resources/assets/vendors/datatables.net/jquery.dataTables.js",
    "resources/assets/vendors/datatables.net-bs4/dataTables.bootstrap4.js",
    "resources/assets/js/off-canvas.js",
    "resources/assets/js/hoverable-collapse.js",
    "resources/assets/js/template.js",
    "resources/assets/js/dashboard.js",
    "resources/assets/js/data-table.js",
    "resources/assets/js/jquery.dataTables.js",
    "resources/assets/js/dataTables.bootstrap4.js",
], 'public/js/app.js');

mix.styles([
    "resources/assets/vendors/mdi/css/materialdesignicons.min.css",
    "resources/assets/vendors/base/vendor.bundle.base.css",
    "resources/assets/vendors/datatables.net-bs4/dataTables.bootstrap4.css",
    "resources/assets/css/style.css",
], 'public/css/app.css');
