<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

// Route for displaying the grid
$routes->get('grid', 'GridController::index');

// Route for handling the print request
$routes->post('grid/print', 'GridController::print');

// Route for generating the PDF
$routes->get('grid/generatePdf', 'GridController::generatePdf');