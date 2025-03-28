### 1.2.2: May 6th, 2024
* add new default days for 4 nights trips

### 1.2.1: May 6th, 2024
* Change the permalink for Accomodations and use the worpress native permalinks instead of the ACF values (resaweb url or site url).
  
### 1.2.0: January 5th, 2023
* Allow looking for a resaweb discovery price 

### 1.1.21: April 11th, 2022
* Update Moment to 2.29.2
* New package price attribute: nblocations

### 1.1.20: November 23rd, 2021
* **Tweak** - Resaweb integration, add suffix parameter (double pipe || to line break in suffix)

### 1.1.19: Janvuary 14th, 2020
* **Fix** - Queried objets not correctly obtained in Loop Elements in Elementor Theme Builder (new fix)

### 1.1.18: December 5th, 2019
* Update Elementor query actions

### 1.1.17: August 6th, 2019
* **Tweak** - Reformat discovery price format
* **Fix** - Queried objets not correctly obtained in Loop Elements in Elementor Theme Builder

### 1.1.16: June 17th, 2019
* **Fix** - Remove wc_price() dependency

### 1.1.15: June 17th, 2019
* **New** - ACF for Discovery: new field sale price

### 1.1.14: June 13th, 2019
* **Tweak** - Update Louvre renamed des Marins

### 1.1.13: March 29th, 2019
* **Fix** - Resaweb package price should have default nights number of accommodation
* **Fix** - Change thalasso domain

### 1.1.12: November 2nd, 2018
* **Fix** - Format Spa Treatment Price
* **Tweak** - Instructions for Spa Treatment Price field
* **Fix** - Check accommodation var before calling it

### 1.1.11: October 19th, 2018
* **New** - Add phone to discovery button
* **New** - Elementor Dynamic Tag: Spa Treatment Price Per Person

### 1.1.10: October 18th, 2018
* **New** - Elementor Dynamic Tag: Book Room Button Label
* **Fix** - Body class only on single

### 1.1.9: October 17th, 2018
* **Tweak** - Refactoring post/body classes
* **Tweak** - Package price with option to select accommodation, for best or without accommodation
* **Tweak** - Package field "package available" not required
* **Tweak** - Accommodation permalink to website_url by default
* **Tweak** - Allow Excerpt for Accommodation

### 1.1.8: September 21th, 2018
* **New** - Elementor Dynamic Tag: Criteo Product ID
* **New** - ACF for Discovery: new field video
* **New** - Post class for CPT without urls, to allow hiding parts of the archive page (loop)
* **New** - CSS classes to hide buttons when no url

### 1.1.7: September 20th, 2018
* **New** - Elementor Dynamic Tag: Resaweb URL No Accommodation
* **New** - Elementor Dynamic Tag: Package Price Explanation
* **New** - Body class for CPT without urls, to allow hiding parts of the single page
* **New** - Accommodation CPT: redirect to resaweb_url
* **Fix** - Order package/accommodation/spatreatment/discovery by order_menu
* **Tweak** - Allow comments for Package CPT

### 1.1.6: September 11th, 2018
* **New** - Order package/accommodation/spatreatment/discovery by order_menu
* **New** - Elementor Dynamic Tag: No Accommodation / Package Price
* **Tweak** - ACF for Package, field advantages as full editor
* **Tweak** - Elementor Dynamic tags refactoring
* **Fix** - Field accommodation relation in Elementor Custom Query "accommodationpackage_price"

### 1.1.5: September 7th, 2018
* **New** - Elementor Custom Query "accommodationpackage_price"
* **New** - Elementor Custom Query "package_discover"

### 1.1.4: September 6th, 2018
* **New** - ACF for Package, new field accommodation

### 1.1.3: September 6th, 2018
* **New** - Elementor Dynamic Tag: Book Resaweb URL (contextual to Accommodation and/or Package)

### 1.1.2: September 5th, 2018
* **New** - Elementor Dynamic Tag: PackageRatesCards
* **New** - ACF, secondary description for custom taxonomies
* **New** - Elementor Dynamic Tag: Book Package Price
* **New** - ACF new relation for Trip Type: Accommodation Type
* **Tweak** - Make ACF field pitch translatable
* **Tweak** - Make ACF field secondary_desc translatable

### 1.1.1: August 30th, 2018
* **Tweak** - Change the way ACF Fields are loaded (PHP replaced JSON)
* **New** - ACF for Package, new field pitch

### 1.1.0: August 28th, 2018
* **Tweak** - Remove Advanced Custom Fields files in the plugin
* **Tweak** - Advanced Custom Fields Pro now required for gallery field
* **New** - ACF for Package, Accommodation, Discovery, Spa Treatment: new field gallery

### 1.0.9: August 2nd, 2018
* **Fix** - Not all default nights were loading prices from resaweb
* **Tweak** - ACF for Trip Type and Accommodation Type, new field defaultnights
* **Fix** - Change accommodations orders: menuorder with menu_order
* **Tweak** - Add caption to table PackageRatesTable
* **Tweak** - Don't display rates if accommodation doesn't have resaweb

### 1.0.8: August 1st, 2018
* **New** - Elementor Dynamic Tag: PackageRatesTable
* **New** - Compatibility with themes: Stormbringer, OceanWP
* **Fix** - Exclude Moment library locale file when locale is english
* **Tweak** - ACF for Package, new field codename

### 1.0.7: August 1st, 2018
* **New** - Elementor Dynamic Tag: Book Room Button Label
* **New** - Elementor Dynamic Tag: Accommodation URL
* **New** - CSS: Remove links with class .hideifnohref if href=#
* **Tweak** - Custom Post Types: Package, Accommodation, Discovery, Spa Treatment now have an archive
* **Tweak** - ACF for Accommodation, field resaweb_url not required
* **Tweak** - ACF for Accommodation, new field website_url
* **Tweak** - ACF for Accommodation, new field email
* **Tweak** - ACF for Accommodation, field stars now required
* **Tweak** - Check if calendar is present in page before starting Clndr

### 1.0.6: July 30th, 2018
* **Tweak** - ACF for Discovery, field discovery_type required
* **Tweak** - ACF for Package, field package_type not required

### 1.0.5: July 30th, 2018
* **Tweak** - ACF for Discovery, new field discovery_type

### 1.0.4: July 30th, 2018
* **Tweak** - ACF for Discovery, new field duration

### 1.0.3: July 27th, 2018
* **Fix** - Github Updater compatibility
* **Tweak** - ACF for Spa Treatment, new field persons
* **Tweak** - ACF for Spa Treatment, new field spatreatment_type
* **Tweak** - ACF for Discovery, new field price

### 1.0.2: July 26th, 2018
* **Tweak** - Enable post_content and post_excerpt for easier content migration
* **Tweak** - ACF Disable Autocomplete
* **Tweak** - Update ACF Fields: reorder, textarea format

### 1.0.1: July 26th, 2018
* **New** - Custom Post Types: Package, Accommodation, Discovery, Spa Treatment
* **New** - ACF Fields

### 1.0.0: April 20th, 2018
* Plugin boilerplate