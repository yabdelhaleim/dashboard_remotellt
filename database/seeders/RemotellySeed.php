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
            Booking::create([
                'client_name'       => 'أحمد محمود',
                'client_phone'      => '01012345678',
                'client_whatsapp'   => '01012345678',
                'business_type'     => 'محل ملابس جاهزة',
                'selected_products' => ['نظام إدارة المخازن (مخزني)', 'نظام نقاط البيع السريعة (POS)'],
                'meeting_date'      => now()->addDay()->toDateString(),
                'meeting_time_slot' => '02:00 م',
                'status'            => 'new',
                'notes'             => 'نريد ربط النظام بفرعين منفصلين ومزامنة المبيعات.',
            ]);

            Booking::create([
                'client_name'        => 'سارة عبد الرحمن',
                'client_phone'       => '01122334455',
                'client_whatsapp'    => '01122334455',
                'business_type'      => 'شركة شحن وتوصيل',
                'selected_products'  => [],
                'custom_program_idea'=> 'تطبيق هاتف للعملاء لتتبع الشحنات مع لوحة تحكم إدارية للمندوبين.',
                'meeting_date'       => now()->addDays(2)->toDateString(),
                'meeting_time_slot'  => '04:00 م',
                'status'             => 'confirmed',
                'meeting_link'       => 'https://meet.google.com/abc-defg-hij',
                'notes'              => 'فكرة مخصصة بالكامل.',
            ]);
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
