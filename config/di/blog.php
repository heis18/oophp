<?php
/**
 * Configuration file for DI container.
 */
return [
    "services" => [
        "blog" => [
            "shared" => true,
            "callback" => function () {
                $url = new \Heis\Blog\BlogService();
                $url->setDI($this);
                $request = $this->get("request");
                #$url->setSiteUrl($request->getSiteUrl());
                #$url->setBaseUrl($request->getBaseUrl());
                #$url->setStaticSiteUrl($request->getSiteUrl());
                #$url->setStaticBaseUrl($request->getBaseUrl());
                #$url->setScriptName($request->getScriptName());
                #$url->configure("url.php");
                #$url->setDefaultsFromConfiguration();
                return $url;
            }
        ],
    ],
];
