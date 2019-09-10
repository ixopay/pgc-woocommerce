# Release Notes

## Unreleased
### Added
- [README](README.md) note on enabling/disabling additional adapters
- Enable seamless integration by setting integration key

## v1.1.0 (2019-09-03)
### Added
- Configuration option for API host per card
- 3D Secure 2.0 extra data
### Changed
- API Password internal option name (has to be set again)
### Fixed
- Use `wc_get_checkout_url()` instead of deprecated `WC_Cart::get_checkout_url()`.

## v1.0.0 (2019-08-29)
### Added
- Build script and [README](README.md) with instructions
- [CHANGELOG](CHANGELOG.md)
### Changed
- Moved renamed source to `src`

## 2019-07-05
### Added
- Module & payment extension
- Credit card payment with redirect flow
- Configuration values for card types
