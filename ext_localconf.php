<?php
if (!defined('TYPO3_MODE')) {
	die('Access denied.');
}

call_user_func(
    function($extensionKey) {
        $GLOBALS['TYPO3_CONF_VARS']['EXTCONF']['vhs']['setup'] =
            \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance(\TYPO3\CMS\Core\Configuration\ExtensionConfiguration::class)
                ->get($extensionKey);

        if (!isset($GLOBALS['TYPO3_CONF_VARS']['EXTCONF']['vhs']['setup']['disableAssetHandling']) || !$GLOBALS['TYPO3_CONF_VARS']['EXTCONF']['vhs']['setup']['disableAssetHandling']) {
            $GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['tslib/class.tslib_fe.php']['usePageCache'][] = \FluidTYPO3\Vhs\Service\AssetService::class;
            $GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['tslib/class.tslib_fe.php']['contentPostProc-output'][] =  \FluidTYPO3\Vhs\Service\AssetService::class . '->buildAllUncached';
            $GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['t3lib/class.t3lib_tcemain.php']['clearCachePostProc'][] =  \FluidTYPO3\Vhs\Service\AssetService::class . '->clearCacheCommand';
        }

        if (!is_array($GLOBALS['TYPO3_CONF_VARS']['SYS']['caching']['cacheConfigurations']['vhs_main'])) {
            $GLOBALS['TYPO3_CONF_VARS']['SYS']['caching']['cacheConfigurations']['vhs_main'] = [
                'frontend' => \TYPO3\CMS\Core\Cache\Frontend\VariableFrontend::class,
                'options' => [
                    'defaultLifetime' => 804600
                ],
                'groups' => ['pages', 'all']
            ];
        }

        if (!is_array($GLOBALS['TYPO3_CONF_VARS']['SYS']['caching']['cacheConfigurations']['vhs_markdown'])) {
            $GLOBALS['TYPO3_CONF_VARS']['SYS']['caching']['cacheConfigurations']['vhs_markdown'] = [
                'frontend' => \TYPO3\CMS\Core\Cache\Frontend\VariableFrontend::class,
                'options' => [
                    'defaultLifetime' => 804600
                ],
                'groups' => ['pages', 'all']
            ];
        }

        $GLOBALS['TYPO3_CONF_VARS']['SYS']['fluid']['namespaces']['v'] = ['FluidTYPO3\\Vhs\\ViewHelpers'];


        // add navigtion hide to fix menu viewHelpers (e.g. breadcrumb)
        $GLOBALS['TYPO3_CONF_VARS']['FE']['addRootLineFields'] .= (empty($GLOBALS['TYPO3_CONF_VARS']['FE']['addRootLineFields']) ? '' : ',') . 'nav_hide,shortcut,shortcut_mode';

        // add and urltype to fix the rendering of external url doktypes
        if (isset($GLOBALS['TCA']['pages']['columns']['urltype'])) {
            $GLOBALS['TYPO3_CONF_VARS']['FE']['addRootLineFields'] .= ',url,urltype';
        }
    }, 'vhs'
);








