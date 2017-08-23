<?php session_start();
$start = microtime(true);
/**
 * CBT v1.5
 *
 * A software for web based exam, test or quiz built on PHP
 *
 * Copyright (c) 2015 - 2016, Megafuse Technologies
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 *
 * @package	CBT v1.2
 * @author	Megafuse Dev Team
 * @copyright	Copyright (c) 2015 - 2016, Megafuse Tech.
 * @link	https://megacbt.org
 * @since	Version 1.2
 * @filesource
 *---------------------------------------------------------------
 * Import Render
 *---------------------------------------------------------------
 * This class consist of method that serve
 * the main content of the
 */
require 'app/Render.php';
/**
 * @render creating and instrance of render()
 */
$render = new Render();
/**
 * @load_class including the Model which handle the
 * Database objects
 */

$render -> load_class('db/Model');

/**
 * --------------------------------------------------------------
 *   Loading Page
 * ---------------------------------------------------------------
 *  Conditions to check the current page to be loaded into the
 *  render object
 */

if (isset($_GET['page'])) {

     $page = '';
     $title = '';

    if (isset($_SESSION['page']) and $_SESSION['page'] == 'confirm' and (isset($_SESSION['_matric_no_key']))) {

            $page = 'confirm-course';
           $title = 'Confirm Course ::';

    }else if(isset($_SESSION['page']) and $_SESSION['page'] == 'start') {

            $page = 'start';
           $title = 'Quiz in progress :: ';

    } else if(!isset($_SESSION['_matric_no_key'])) {

        $page = $_GET['page'];
       $title = 'Sigin :: ';

    } else {

       $page = 'login';
       $title = 'Sigin :: MegaFuse Tech.';

    }

    $render -> render_page($page, $title);

} else {

    $render -> render_page('error');
}

//$result = round(microtime(true) - $start, 4);
//print "<center><small class='smaller'> Page loads @ $result seconds</small></center>";
