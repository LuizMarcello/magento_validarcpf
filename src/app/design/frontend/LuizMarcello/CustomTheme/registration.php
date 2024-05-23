<?php

use Magento\Framework\Component\ComponentRegistrar;
use Magento\Paypal\Block\Express\InContext\Component;

ComponentRegistrar::register(
  ComponentRegistrar::THEME,
  'frontend/LuizMarcello/CustomTheme',
  __DIR__
);
