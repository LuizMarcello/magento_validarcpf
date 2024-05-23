<?php return array(
    'root' => array(
        'pretty_version' => '1.0.0+no-version-set',
        'version' => '1.0.0.0',
        'type' => 'library',
        'install_path' => __DIR__ . '/../../',
        'aliases' => array(),
        'reference' => NULL,
        'name' => '__root__',
        'dev' => true,
    ),
    'versions' => array(
        '__root__' => array(
            'pretty_version' => '1.0.0+no-version-set',
            'version' => '1.0.0.0',
            'type' => 'library',
            'install_path' => __DIR__ . '/../../',
            'aliases' => array(),
            'reference' => NULL,
            'dev_requirement' => false,
        ),
        'n98/magerun2' => array(
            'dev_requirement' => false,
            'replaced' => array(
                0 => '7.4.0',
            ),
        ),
        'n98/magerun2-dist' => array(
            'pretty_version' => '7.4.0',
            'version' => '7.4.0.0',
            'type' => 'library',
            'install_path' => __DIR__ . '/../n98/magerun2-dist',
            'aliases' => array(),
            'reference' => 'f4ce47491f87491777485396b38c689b9c860dc3',
            'dev_requirement' => false,
        ),
        'rafaelstz/traducao_magento2_pt_br' => array(
            'pretty_version' => 'dev-master',
            'version' => 'dev-master',
            'type' => 'magento2-language',
            'install_path' => __DIR__ . '/../rafaelstz/traducao_magento2_pt_br',
            'aliases' => array(
                0 => '9999999-dev',
            ),
            'reference' => 'dac44535a1886dd6b25807fd0c1d7090de19032e',
            'dev_requirement' => false,
        ),
    ),
);
