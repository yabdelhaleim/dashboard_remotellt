<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Booking;
use App\Models\Lead;

class RemotellySeed extends Seeder
{
    public function run(): void
    {
        // ================================================================
        // Products
        // ================================================================
        $products = [
            [
                'slug'        => 'warehouse',
                'name'        => 'نظام إدارة المخازن (مخزني)',
                'description' => 'نظام ذكي متكامل لإدارة المخزون، المبيعات، المشتريات، الموردين، وإصدار تقارير الأداء مع دعم متكامل للباركود.',
                'icon'        => '📦',
                'sort_order'  => 1,
                'packages'    => [
                    ['name' => 'الأساسية',   'price' => 299, 'highlighted' => false, 'sort_order' => 1, 'features' => ['إدارة المخزون الأساسية', 'تقارير يومية', 'مستخدم واحد']],
                    ['name' => 'المتقدمة',   'price' => 499, 'highlighted' => true,  'sort_order' => 2, 'features' => ['كل مميزات الأساسية', 'تقارير متقدمة وتنبيهات', '3 مستخدمين', 'دعم الباركود والطباعة']],
                    ['name' => 'المؤسسات',   'price' => 899, 'highlighted' => false, 'sort_order' => 3, 'features' => ['كل مميزات المتقدمة', 'مستخدمين غير محدود', 'API للربط', 'دعم فني مخصص 24/7']],
                ],
            ],
            [
                'slug'        => 'restaurant',
                'name'        => 'نظام إدارة المطاعم والكافيهات',
                'description' => 'إدارة الطاولات، الطلبات، الكابتن، وتوصيل الطلبات مع إعداد المطبخ المباشر وتقارير الأرباح.',
                'icon'        => '🍔',
                'sort_order'  => 2,
                'packages'    => [
                    ['name' => 'الأساسية', 'price' => 199, 'highlighted' => false, 'sort_order' => 1, 'features' => ['إدارة القائمة والوجبات', 'طلبات الصالة المباشرة', 'مستخدم واحد']],
                    ['name' => 'المتقدمة', 'price' => 399, 'highlighted' => true,  'sort_order' => 2, 'features' => ['تكامل نقاط البيع POS', 'إدارة طاولات ومطبخ', 'تقارير مبيعات شهرية']],
                ],
            ],
            [
                'slug'        => 'pos',
                'name'        => 'نظام نقاط البيع السريعة (POS)',
                'description' => 'كاشير سريع وموثوق للمحلات التجارية، السوبر ماركت، والصيدليات مع دعم أجهزة الدفع وقارئ الباركود.',
                'icon'        => '💻',
                'sort_order'  => 3,
                'packages'    => [],
            ],
            [
                'slug'        => 'crm',
                'name'        => 'إدارة علاقات العملاء (CRM)',
                'description' => 'متابعة العملاء، إدارة المبيعات، جدولة المهام والمواعيد، وتتبع خطوط أنابيب الصفقات لزيادة الأرباح.',
                'icon'        => '🤝',
                'sort_order'  => 4,
                'packages'    => [],
            ],
        ];

        foreach ($products as $pd) {
            $pkgs = $pd['packages'];
            unset($pd['packages']);
            $product = Product::firstOrCreate(['slug' => $pd['slug']], $pd);
            foreach ($pkgs as $pkg) {
                $product->packages()->firstOrCreate(['name' => $pkg['name']], $pkg);
            }
        }

        // ================================================================
        // Sample Bookings
        // ================================================================
        if (Booking::count() === 0) {
            // Helper to get N-th future business day (skipping Fridays = 5)
            $getFutureBusinessDay = function (int $offsetFromToday) {
                $date = now();
                $added = 0;
                while ($added < $offsetFromToday) {
                    $date->addDay();
                    if ($date->dayOfWeek !== 5) {
                        $added++;
                    }
                }
                return $date->toDateString();
            };

            // Helper to get N-th past business day (skipping Fridays = 5)
            $getPastBusinessDay = function (int $offsetPast) {
                $date = now();
                $subtracted = 0;
                while ($subtracted < $offsetPast) {
                    $date->subDay();
                    if ($date->dayOfWeek !== 5) {
                        $subtracted++;
                    }
                }
                return $date->toDateString();
            };

            $bookings = [
                [
                    'client_name'       => 'أحمد محمود',
                    'client_phone'      => '01012345678',
                    'client_whatsapp'   => '01012345678',
                    'business_type'     => 'محل ملابس جاهزة',
                    'selected_products' => ['نظام إدارة المخازن (مخزني)', 'نظام نقاط البيع السريعة (POS)'],
                    'meeting_date'      => $getFutureBusinessDay(1),
                    'meeting_time_slot' => '12:00 م',
                    'status'            => 'new',
                    'notes'             => 'نريد ربط النظام بفرعين منفصلين ومزامنة المبيعات.',
                ],
                [
                    'client_name'        => 'سارة عبد الرحمن',
                    'client_phone'       => '01122334455',
                    'client_whatsapp'    => '01122334455',
                    'business_type'      => 'شركة شحن وتوصيل',
                    'selected_products'  => [],
                    'custom_program_idea'=> 'تطبيق هاتف للعملاء لتتبع الشحنات مع لوحة تحكم إدارية للمندوبين.',
                    'meeting_date'       => $getFutureBusinessDay(2),
                    'meeting_time_slot'  => '04:00 م',
                    'status'             => 'confirmed',
                    'meeting_link'       => 'https://meet.google.com/abc-defg-hij',
                    'notes'              => 'فكرة مخصصة بالكامل.',
                ],
                [
                    'client_name'       => 'محمود كمال',
                    'client_phone'      => '01234567890',
                    'client_whatsapp'   => '01234567890',
                    'business_type'     => 'سوبر ماركت كبير',
                    'selected_products' => ['نظام إدارة المخازن (مخزني)', 'نظام نقاط البيع السريعة (POS)'],
                    'meeting_date'      => $getPastBusinessDay(2),
                    'meeting_time_slot' => '10:00 ص',
                    'status'            => 'completed',
                    'notes'             => 'تم تثبيت الكاشير وتدريب الموظفين.',
                ],
                [
                    'client_name'       => 'منى علي',
                    'client_phone'      => '01099887766',
                    'client_whatsapp'   => '01099887766',
                    'business_type'     => 'عيادة طبية مخصصة',
                    'selected_products' => ['إدارة علاقات العملاء (CRM)'],
                    'meeting_date'      => $getFutureBusinessDay(1),
                    'meeting_time_slot' => '02:00 م',
                    'status'            => 'confirmed',
                    'meeting_link'       => 'https://meet.google.com/xyz-pdqr-tuv',
                    'notes'             => 'تحتاج نظام لمتابعة ملفات المرضى وتذكيرهم بالمواعيد.',
                ],
                [
                    'client_name'       => 'ياسر مصطفى',
                    'client_phone'      => '01511223344',
                    'client_whatsapp'   => '01511223344',
                    'business_type'     => 'محل تجاري مستحضرات تجميل',
                    'selected_products' => ['نظام نقاط البيع السريعة (POS)'],
                    'meeting_date'      => $getFutureBusinessDay(3),
                    'meeting_time_slot' => '11:00 ص',
                    'status'            => 'new',
                    'notes'             => 'استفسار عن توافق طابعة الفواتير مع النظام.',
                ],
                [
                    'client_name'       => 'هاني فوزي',
                    'client_phone'      => '01288776655',
                    'client_whatsapp'   => '01288776655',
                    'business_type'     => 'كافيه سياحي',
                    'selected_products' => ['نظام إدارة المطاعم والكافيهات'],
                    'meeting_date'      => $getPastBusinessDay(1),
                    'meeting_time_slot' => '03:00 م',
                    'status'            => 'completed',
                    'notes'             => 'تم عقد الاجتماع بنجاح والاتفاق على التفعيل غداً.',
                ],
                [
                    'client_name'       => 'رنا خالد',
                    'client_phone'      => '01144556677',
                    'client_whatsapp'   => '01144556677',
                    'business_type'     => 'شركة تجارة وتوزيع',
                    'selected_products' => ['نظام إدارة المخازن (مخزني)', 'إدارة علاقات العملاء (CRM)'],
                    'meeting_date'      => $getFutureBusinessDay(4),
                    'meeting_time_slot' => '01:00 م',
                    'status'            => 'cancelled',
                    'notes'             => 'اعتذرت العميلة عن الموعد لظروف خاصة.',
                ],
                [
                    'client_name'       => 'عمر شريف',
                    'client_phone'      => '01066554433',
                    'client_whatsapp'   => '01066554433',
                    'business_type'     => 'صيدلية حرة',
                    'selected_products' => ['نظام نقاط البيع السريعة (POS)'],
                    'meeting_date'      => $getFutureBusinessDay(2),
                    'meeting_time_slot' => '08:00 م',
                    'status'            => 'new',
                    'notes'             => 'يرغب في معرفة إمكانية إضافة ميزة صلاحيات الأدوية وتواريخ الانتهاء.',
                ],
                [
                    'client_name'       => 'دينا مجدي',
                    'client_phone'      => '01211223344',
                    'client_whatsapp'   => '01211223344',
                    'business_type'     => 'شركة تسويق عقاري',
                    'selected_products' => ['إدارة علاقات العملاء (CRM)'],
                    'meeting_date'      => $getFutureBusinessDay(5),
                    'meeting_time_slot' => '05:00 م',
                    'status'            => 'confirmed',
                    'meeting_link'       => 'https://meet.google.com/mno-rstu-vwx',
                    'notes'             => 'مناقشة تحسين تدفق المبيعات العقارية.',
                ],
                [
                    'client_name'       => 'طارق حامد',
                    'client_phone'      => '01033445566',
                    'client_whatsapp'   => '01033445566',
                    'business_type'     => 'سلسلة مطاعم وجبات سريعة',
                    'selected_products' => ['نظام إدارة المطاعم والكافيهات', 'نظام إدارة المخازن (مخزني)'],
                    'meeting_date'      => $getFutureBusinessDay(6),
                    'meeting_time_slot' => '12:00 م',
                    'status'            => 'new',
                    'notes'             => 'تكامل النظام مع تطبيقات التوصيل الخارجية.',
                ],
            ];

            foreach ($bookings as $b) {
                Booking::create($b);
            }
        }

        // ================================================================
        // Sample Leads
        // ================================================================
        if (Lead::count() === 0) {
            Lead::create([
                'name'     => 'محمد علي',
                'phone'    => '01098765432',
                'whatsapp' => '01098765432',
                'address'  => 'الإسكندرية',
                'business' => 'مطعم شاورما',
                'product'  => 'نظام إدارة المطاعم',
                'package'  => 'المتقدمة',
                'status'   => 'new',
            ]);
        }

        // ================================================================
        // Sample Tickets
        // ================================================================
        if (\App\Models\Ticket::count() === 0) {
            \App\Models\Ticket::create([
                'client_name'       => 'محمد أحمد',
                'client_phone'      => '01012345678',
                'client_whatsapp'   => '01012345678',
                'system_name'       => 'نظام إدارة المخازن (مخزني)',
                'type'              => 'support',
                'priority'          => 'high',
                'status'            => 'open',
                'title'             => 'مشكلة في طباعة الفواتير الحرارية',
                'description'       => 'عند محاولة طباعة فاتورة مبيعات، يظهر خطأ في قارئ الباركود ولا يتم استجابة طابعة الفواتير إطلاقاً.',
            ]);

            \App\Models\Ticket::create([
                'client_name'       => 'خالد محمود',
                'client_phone'      => '01234567890',
                'client_whatsapp'   => '',
                'system_name'       => 'نظام إدارة المطاعم والكافيهات',
                'type'              => 'modification',
                'priority'          => 'medium',
                'status'            => 'resolved',
                'title'             => 'إضافة حقل لنسبة الخصم الإجمالية في شاشة الكابتن',
                'description'       => 'نحتاج لإضافة إمكانية إدخال خصم بنسبة مئوية على الفاتورة بأكملها من خلال شاشة الكابتن قبل التأكيد.',
                'admin_reply'       => 'تمت إضافة الميزة بنجاح في التحديث الأخير للنظام رقم v2.4.1، يمكنك الآن استخدامه مباشرة.',
                'admin_reply_at'    => now()->subDay(),
            ]);
        }

        $this->command->info('✅ Remotelly seed completed successfully!');
    }
}
