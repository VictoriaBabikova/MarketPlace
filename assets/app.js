/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you import will output into a single css file (app.css in this case)
import './styles/css/basic.css';
import './styles/css/extra.css';
import './styles/css/fonts.css';

require('./styles/plg/jQuery/jquery-3.5.0.slim.min.js');
require('./styles/plg/form/jquery.form');
require('./styles/plg/form/jquery.maskedinput.min.js');
require('./styles/plg/range/ion.rangeSlider.min.js');
require('./styles/plg/Slider/slick.min.js');
require('./styles/js/scripts.js');

require('./styles/plg/CountDown/countdown.js');
require('./styles/plg/CountDown/jquery.countdown.js');
//require('./styles/js/bootstrap_file_field.js')

// start the Stimulus application
import './bootstrap';
