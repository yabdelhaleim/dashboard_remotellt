<!DOCTYPE html>
<html lang="ar" dir="rtl">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        
        <!-- Google Search Console Ownership Verification if needed -->
        <meta name="google-site-verification" content="" />

        <!-- Primary SEO Meta Tags -->
        <title>Remotelly | ريموتلي لتطوير الأنظمة السحابية وتطبيقات الجوال</title>
        <meta name="title" content="Remotelly | ريموتلي لتطوير الأنظمة السحابية وتطبيقات الجوال">
        <meta name="description" content="وكالة ريموتلي (Remotelly) لتصميم وتطوير الأنظمة السحابية المتكاملة (SaaS) وتطبيقات الهواتف الذكية (iOS & Android). نساعدك على أتمتة مبيعاتك، مخازنك، ومطاعمك بكفاءة وأمان.">
        <meta name="keywords" content="ريموتلي, remotelly, أنظمة سحابية, كاشير, نظام نقاط البيع, POS, إدارة مخازن, إدارة مطاعم, تطبيقات جوال, أتمتة مبيعات, SaaS, تطوير برمجيات">
        <meta name="robots" content="index, follow">
        <meta name="language" content="Arabic">
        <meta name="author" content="Remotelly">
        <link rel="canonical" href="https://remotelly1.site/">

        <!-- Favicon Links for Browsers & Google Search Results -->
        <link rel="icon" type="image/svg+xml" href="/favicon.svg" />
        <link rel="shortcut icon" href="/favicon.ico" />
        <link rel="apple-touch-icon" href="/favicon.svg" />

        <!-- Open Graph / Facebook / WhatsApp / Telegram Meta Tags -->
        <meta property="og:type" content="website">
        <meta property="og:url" content="https://remotelly1.site/">
        <meta property="og:title" content="Remotelly | ريموتلي لتطوير الأنظمة السحابية وتطبيقات الجوال">
        <meta property="og:description" content="وكالة ريموتلي لتصميم وتطوير الأنظمة السحابية المتكاملة (SaaS) وتطبيقات الهواتف الذكية. حلول تقنية ذكية لإدارة مبيعاتك، مخازنك، ومطاعمك من أي مكان.">
        <meta property="og:image" content="https://remotelly1.site/logo-dark.svg">

        <!-- Twitter Card Meta Tags -->
        <meta property="twitter:card" content="summary_large_image">
        <meta property="twitter:url" content="https://remotelly1.site/">
        <meta property="twitter:title" content="Remotelly | ريموتلي لتطوير الأنظمة السحابية وتطبيقات الجوال">
        <meta property="twitter:description" content="وكالة ريموتلي لتصميم وتطوير الأنظمة السحابية المتكاملة (SaaS) وتطبيقات الهواتف الذكية. حلول تقنية ذكية لإدارة مبيعاتك، مخازنك، ومطاعمك من أي مكان.">
        <meta property="twitter:image" content="https://remotelly1.site/logo-dark.svg">

        <!-- Schema.org JSON-LD Structured Data for Google Rich Snippets -->
        <script type="application/ld+json">
        {
          "@@context": "https://schema.org",
          "@type": "SoftwareApplication",
          "name": "Remotelly",
          "operatingSystem": "All",
          "applicationCategory": "BusinessApplication",
          "offers": {
            "@type": "Offer",
            "priceCurrency": "EGP"
          },
          "publisher": {
            "@type": "Organization",
            "name": "Remotelly",
            "url": "https://remotelly1.site/",
            "logo": "https://remotelly1.site/favicon.svg"
          },
          "description": "منصة ريموتلي لتصميم وتطوير الأنظمة السحابية المتكاملة وتطبيقات الجوال لأتمتة ومراقبة مبيعات ومخازن المحلات والمطاعم."
        }
        </script>

        <!-- Google Fonts Direct Loading -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="{{ 'https://fonts.googleapis.com/css2?family=Cairo:wght@300;400;500;600;700;800;900&family=Tajawal:wght@300;400;500;700;800;900&family=IBM+Plex+Mono:wght@400;500;600&display=swap' }}" rel="stylesheet">

        <!-- ============================================================
             Analytics & Tracking — GA4 + Meta Pixel
             IDs are injected from .env via Laravel.
             Vue app reads them via window.REMOTELY_TRACKING (see analytics.js)
             ============================================================ -->
        @php
            $ga4Id = env('GA4_MEASUREMENT_ID', '');
            $metaPixelId = env('META_PIXEL_ID', '');
        @endphp

        @if(!empty($ga4Id))
            <!-- Google Analytics GA4 -->
            <script async src="https://www.googletagmanager.com/gtag/js?id={{ $ga4Id }}"></script>
            <script>
                window.dataLayer = window.dataLayer || [];
                function gtag(){ dataLayer.push(arguments); }
                gtag('js', new Date());
                gtag('config', '{{ $ga4Id }}', {
                    send_page_view: true,
                    anonymize_ip: true,
                    cookie_flags: 'SameSite=None;Secure',
                });
            </script>
        @endif

        @if(!empty($metaPixelId))
            <!-- Meta (Facebook) Pixel -->
            <script>
                !function(f,b,e,v,n,t,s)
                {if(f.fbq)return;n=f.fbq=function(){n.callMethod?
                n.callMethod.apply(n,arguments):n.queue.push(arguments)};
                if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
                n.queue=[];t=b.createElement(e);t.async=!0;
                t.src=v;s=b.getElementsByTagName(e)[0];
                s.parentNode.insertBefore(t,s)}(window, document,'script',
                'https://connect.facebook.net/en_US/fbevents.js');
                window.fbq('init', '{{ $metaPixelId }}');
                window.fbq('track', 'PageView');
            </script>
            <noscript>
                <img height="1" width="1" style="display:none"
                     src="https://www.facebook.com/tr?id={{ $metaPixelId }}&ev=PageView&noscript=1" />
            </noscript>
        @endif

        <!-- Expose tracking IDs to the Vue app so analytics.js can use them
             (and avoid re-importing in the bundle). Safe — empty strings
             if not configured. -->
        <script>
            window.REMOTELY_TRACKING = {
                ga4: @json($ga4Id),
                metaPixel: @json($metaPixelId),
            };
        </script>

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <!-- Change body background to matching dark navy bg-[#0A0E1A] to avoid white flash on load -->
    <body class="bg-[#0A0E1A] text-dark-text antialiased">
        <div id="app"></div>
    </body>
</html>
