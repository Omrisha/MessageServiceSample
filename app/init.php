<?php

if (!defined("IN_APP")) die;

// Server config
define("API_HOST_ADDR", "0.0.0.0");
define("API_HOST_PORT", 80);

// API Configurations
define("API_BASE_PATH", "api/v1");
define("API_SERVER_TZ", "America/New_York");


// Directories
define("SRC_DIR", __DIR__);
define("MOCK_DIR", __DIR__ . '/../mock');
define("ROUTES_DIRNAME", "routes");