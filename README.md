TMSM WooCommerce Booking Thalasso
=================

WooCommerce Booking Thalasso for Thermes Marins de Saint-Malo

Features
-----------

Requires Advanced Custom Fields Pro v5.3.7+

* Register Post Types:
    * Accommodation
    * Package
    * Discovery
    * Spa Treatment
* Register Taxonomies:
    * Accommodation Type
    * Package Type
    * Trip Type
    * Discovery Type
    * Spa Treatment Type
* ACF Fields for the 4 Custom Post Types
* Elementor Custom Query "accommodationpackage_price"
* Elementor Custom Query "accommodationpackage_price"
* Polylang translation settings for every ACF field (`sync` or `translate`), plus a
  fix for ACF taxonomy fields not being synchronized to translations (see below)

Polylang / ACF translation sync
-----------

Requires Polylang Pro.

Every ACF field registered by this plugin declares a `translations` setting
(`sync` or `translate`) so Polylang Pro knows how to handle it across languages:

* `translate`: editorial content, translated independently per language
  (descriptions, addresses, pitch, URLs, etc.).
* `sync`: factual data that must stay identical across languages (phone, price,
  stars, dates, taxonomies, etc.) — automatically pushed to every translation
  whenever the field is saved.

**Known ACF/Polylang conflict and its fix**

ACF Pro batches `wp_set_object_terms()` calls for taxonomy-type fields in a
single request-wide queue and flushes it, on `acf/save_post`, against the
post ID of the currently submitted post only. When Polylang Pro's ACF
integration pushes a `sync` taxonomy field value to a translation mid-save,
ACF queues that translation's terms too, but flushes them onto the source
post instead — the translation's ACF postmeta ends up correct, but the
taxonomy assignment itself never reaches the database.

`Tmsm_Woocommerce_Booking_Thalasso_Admin::acf_fix_synced_taxonomy_fields()`
(hooked on `acf/save_post`, priority 20) works around this: it re-applies the
`sync` taxonomy fields' terms directly to every translation, translating the
term via `pll_get_term()` for taxonomies registered as translated in
Polylang (Accommodation/Package/Trip/Discovery/Spa Treatment Type), or
copying the raw term ID for taxonomies that are not (Duration, Objective).
It never removes a term assigned to a translation independently of the field
(e.g. via the native taxonomy metabox) — it only touches what it previously
pushed itself, tracked in a private `_pll_acf_sync_{field_key}` post meta.

**"Synchronize this post" button hidden**

Polylang Pro's own "Synchronize this post" button (the repeat-icon toggle in
the language metabox) is hidden on the 4 custom post types via
`Tmsm_Woocommerce_Booking_Thalasso_Admin::acf_hide_sync_post_button()`
(hooked on `admin_head`). That button copies *every* custom field verbatim
to the translation, ignoring each field's `translations` setting — enabling
it would silently overwrite `translate` fields (descriptions, addresses,
etc.) with the source language's content. It is hidden with CSS rather than
Polylang's own settings, to avoid touching Polylang Pro's code.