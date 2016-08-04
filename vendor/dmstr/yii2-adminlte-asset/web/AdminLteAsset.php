<?php
namespace dmstr\web;

use yii\base\Exception;
use yii\web\AssetBundle as BaseAdminLteAsset;

/**
 * AdminLte AssetBundle
 * @since 0.1
 */
class AdminLteAsset extends BaseAdminLteAsset
{
    public $sourcePath = '@vendor/almasaeed2010/adminlte/';
    public $css = [
        'dist/css/AdminLTE.min.css',
        'plugins/morris/morris.css',
        'plugins/jvectormap/jquery-jvectormap-1.2.2.css',
        'plugins/fullcalendar/fullcalendar.css',
        'plugins/daterangepicker/daterangepicker.css',
        'plugins/datepicker/datepicker3.css',
        'plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css',
    ];
    public $js = [
        "plugins/jQueryUI/jquery-ui.min.js",
        "plugins/daterangepicker/moment.min.js",
        "//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js",
        "plugins/morris/morris.min.js",
        "plugins/sparkline/jquery.sparkline.min.js",
        "plugins/jvectormap/jquery-jvectormap-1.2.2.min.js",
        "plugins/jvectormap/jquery-jvectormap-world-mill-en.js",
        "plugins/fullcalendar/fullcalendar.min.js",
        "plugins/Knob/jquery.knob.js",
        "plugins/daterangepicker/daterangepicker.js",
        "plugins/datepicker/bootstrap-datepicker.js",
        "plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js",
        "plugins/iCheck/icheck.min.js",
        "plugins/slimScroll/jquery.slimscroll.min.js",
        'dist/js/app.min.js'
    ];
    public $depends = [
        'rmrevin\yii\fontawesome\AssetBundle',
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
        'yii\bootstrap\BootstrapPluginAsset',
    ];

    /**
     * @var string|bool Choose skin color, eg. `'skin-blue'` or set `false` to disable skin loading
     * @see https://almsaeedstudio.com/themes/AdminLTE/documentation/index.html#layout
     */
    public $skin = '_all-skins';

    /**
     * @inheritdoc
     */
    public function init()
    {
        // Append skin color file if specified
        if ($this->skin) {
            if (('_all-skins' !== $this->skin) && (strpos($this->skin, 'skin-') !== 0)) {
                throw new Exception('Invalid skin specified');
            }

            $this->css[] = sprintf('dist/css/skins/%s.min.css', $this->skin);
        }

        parent::init();
    }
}
