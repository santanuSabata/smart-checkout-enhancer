# Smart Checkout Enhancer

**Version:** 1.0  
**Author:** Santanu Sabata

A WooCommerce plugin that enhances checkout with conditional fees, dynamic cart pricing, analytics, and background processing using Action Scheduler.  

---

## Features

- Add **conditional checkout fees** based on product type, cart total, and user country.  
- **Dynamic cart item price modifications** (discounts or adjustments).  
- Store **checkout analytics** in order meta.  
- Run **background tasks reliably** using Action Scheduler after order completion.  
- **Secure logging** of all important checkout events.  
- **Admin UI** to configure fee amount, country, minimum cart total, and cart price modification toggle.  

---

## Installation

1. Download the repository as a ZIP or clone it:

```bash
git clone https://github.com/yourusername/smart-checkout-enhancer.git

2.Upload the plugin folder to your WordPress site:
wp-content/plugins/smart-checkout-enhancer

Activate the plugin from WordPress Admin → Plugins.

Ensure WooCommerce is active.

Admin Settings

After activation, go to:

WooCommerce → Smart Checkout Enhancer

Configure:

Setting	Description
Conditional Fee Amount	Fee applied at checkout if conditions are met
Fee Country	Only applies to customers in this country
Minimum Cart Total	Fee applies only if cart total is below this
Enable Dynamic Cart Price Modification	Toggle cart price modifications on/off

Click Save Changes to apply.

How It Works
Conditional Fee

Applied only if:

Cart contains a subscription product (or configurable product types)

Customer shipping country matches the setting

Cart total is less than minimum total

Dynamic Cart Prices

Adjusts cart item prices above a threshold (default > 300).

Works for both physical and subscription products (if enabled).

Checkout Analytics

Stored in order meta _sce_checkout_analytics.

Includes order ID, total, country, item count, and timestamp.

Background Jobs

Scheduled using Action Scheduler on order completion.

Reliable, asynchronous processing.

Useful for analytics, notifications, or stock updates.

Logs

All important events are logged via WooCommerce logger.

Access logs: WooCommerce → Status → Logs → smart-checkout-enhancer
