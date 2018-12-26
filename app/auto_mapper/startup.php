<?php
require_once(BASE_DIR . '/app/auto_mapper/dto-to-entity.php');
require_once(BASE_DIR . '/app/auto_mapper/entity-to-dto.php');

use AutoMapperPlus\AutoMapper;
use AutoMapperPlus\Configuration\AutoMapperConfig;

$mapper = AutoMapper::initialize(function (AutoMapperConfig $config) {
    entityToDtoRegisterMapping($config);
    dtoToEntityRegisterMapping($config);    
});
