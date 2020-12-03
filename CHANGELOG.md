# Changelog

All notable changes to this project will be documented in this file.

## [1.1.0] - 2020-12-03

### Breaking Changes

- `liveStreamOnlineList()` first two parameter is now `appName` and `streamName`

### Added

- Add `phpunit.xml.dist` file
- Add `appName` and `streamName` filter for `liveStreamOnlineList()`

### Changes

- Update `.gitignore` to ignore `phpunit.xml`

### Fixed

- Incorrect `stream_urls` returned when beautifying the response

### Removed

- Remove `phpunit.xml` file
- Remove unused `phpunit.xml` env variable
- Remove `getEnvironmentSetUp()` from `TestCase`

## [1.0.0] - 2020-02-04

### Added

- Get live broadcast list
- Block live broadcast
- Resume blocked live broadcast

[1.1.0]: https://github.com/bryanthw1020/live-video-broadcast-manager/compare/v1.0.0...v1.1.0
[1.0.0]: https://github.com/bryanthw1020/live-video-broadcast-manager/releases/tag/v1.0.0
