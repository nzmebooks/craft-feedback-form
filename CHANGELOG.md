# feedback-form Changelog

All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](http://keepachangelog.com/) and this project adheres to [Semantic Versioning](http://semver.org/).

## 2.2.0 - 2023-05-23
### Modified
- Upgrade craftcms/cms to ~4.4 to placate Dependabot

## 2.1.0 - 2022-02-07
### Modified
- Upgrade craftcms/cms to 4.2.1 to placate Dependabot

## 2.0.1 - 2022-07-28
### Fixed
- Under Craft 4 we use `Craft::$app->getProjectConfig()->get('email')` instead of `Craft::$app->getSystemSettings()->getEmailSettings()`

## 2.0.0 - 2022-05-28
### Modified
- Upgrade to Craft 4

## 1.0.2 - 2022-04-15
### Modified
- Correct more psr-4 errors

## 1.0.1 - 2022-04-15
### Modified
- Correct psr-4 errors

## 1.0.0 - 2018-06-25
### Added
- Initial release
