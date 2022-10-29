<?php

use Carbon\Carbon;

if ( ! function_exists('get_list_active_inactive')) {
    /**
     * @return array
     */
    function get_list_active_inactive(): array
    {
        return [
            80 => __('general.active'),
            99 => __('general.inactive')
        ];
    }
}

if ( ! function_exists('get_list_status_users')) {
    /**
     * @return array
     */
    function get_list_status_users(): array
    {
        return [
            1 => __('general.pending'),
            80 => __('general.active'),
            99 => __('general.inactive')
        ];
    }
}

if ( ! function_exists('get_list_available_non_available')) {
    /**
     * @return array
     */
    function get_list_available_non_available(): array
    {
        return [
            80 => __('general.available'),
            99 => __('general.non_available')
        ];
    }
}

if ( ! function_exists('get_list_stock_flag')) {
    function get_list_stock_flag()
    {
        return [
            1 => __('general.unlimited'),
            2 => __('general.limited')
        ];
    }
}


if ( ! function_exists('get_list_gender')) {
    function get_list_gender()
    {
        return [
            1 => __('general.pria'),
            2 => __('general.wanita')
        ];
    }
}

if ( ! function_exists('get_list_book')) {
    function get_list_book()
    {
        return [
            80 => __('Available'),
            99 => __('Book')
        ];
    }
}

if ( ! function_exists('get_list_type_transaction')) {
    function get_list_type_transaction()
    {
        return [
            1 => __('Product'),
            2 => __('Doctor Telemed'),
            3 => __('Doctor HomeCare'),
            4 => __('Doctor Visit'),
            5 => __('Lab Telemed'),
            6 => __('Lab HomeCare'),
            7 => __('Lab Visit'),
            8 => __('Nurse'),
        ];
    }
}

if ( ! function_exists('get_list_type_transaction2')) {
    function get_list_type_transaction2()
    {
        return [
            1 => __('Product'),
            2 => __('Doctor'),
            3 => __('Doctor'),
            4 => __('Doctor'),
            5 => __('Lab'),
            6 => __('Lab'),
            7 => __('Lab'),
            8 => __('Nurse'),
        ];
    }
}

if ( ! function_exists('get_list_type_transaction3')) {
    function get_list_type_transaction3()
    {
        return [
            1 => __('Product'),
            2 => __('Telemed'),
            3 => __('HomeCare'),
            4 => __('Visit'),
            5 => __('Telemed'),
            6 => __('HomeCare'),
            7 => __('Visit'),
            8 => __('Nurse'),
        ];
    }
}

if ( ! function_exists('get_list_target')) {
    function get_list_target()
    {
        return [
            0 => __('All'),
            1 => __('Doctor'),
            2 => __('Patient'),
        ];
    }
}



if ( ! function_exists('check_list_type_transaction')) {
    function check_list_type_transaction($typeService = 'product')
    {
        if (strtolower($typeService) == 'product') {
            return 1;
        }
        else if (strtolower($typeService) == 'doctor') {
            return 2;
        }
        else if (strtolower($typeService) == 'lab') {
            return 3;
        }
        else if (strtolower($typeService) == 'nurse') {
            return 4;
        }
        else if (strtolower($typeService) == 'product_klinik') {
            return 5;
        }
        else if (strtolower($typeService) == 'lab_klinik') {
            return 6;
        }
        else if (strtolower($typeService) == 'product_cash') {
            return 7;
        }
        else if (strtolower($typeService) == 'doctor_cash') {
            return 8;
        }
        else if (strtolower($typeService) == 'lab_cash') {
            return 9;
        }
        return 0;
    }
}

if ( ! function_exists('get_list_transaction')) {
    function get_list_transaction()
    {
        return [
            1 => __('general.pending'),
            2 => __('general.pending_payment'),
            3 => __('general.payment_received'),
            80 => __('general.complete'),
            81 => __('general.proses'),
            82 => __('general.proses_pengiriman'),
            90 => __('general.void'),
            99 => __('general.cancel'),
        ];
    }
}

if ( ! function_exists('get_list_appointment')) {
    function get_list_appointment()
    {
        return [
            0 => __('general.waiting_for_payment'),
            1 => __('general.pending'),
            2 => __('general.reschedule'),
            3 => __('general.meeting'),
            4 => __('general.approve'),
            80 => __('general.complete'),
            90 => __('general.cancel'),
            91 => __('general.reject')
        ];
    }
}

if ( ! function_exists('get_list_appointment_color')) {
    function get_list_appointment_color()
    {
        return [
            1 => __('#f39c12'),
            80 => __('#00a65a'),
            90 => __('#f56954')
        ];
    }
}

if ( ! function_exists('get_list_online_meeting')) {
    function get_list_online_meeting()
    {
        return [
            0 => __('general.no_meeting'),
            1 => __('general.waiting'),
            2 => __('general.meeting'),
            80 => __('general.complete')
        ];
    }
}

if ( ! function_exists('get_list_lang')) {
    function get_list_lang()
    {
        return [
            'en' => __('en'),
            'id' => __('id')
        ];
    }
}

if ( ! function_exists('get_list_recommended_for')) {
    function get_list_recommended_for()
    {
        return [
            'Pria' => __('Pria'),
            'Wanita' => __('Wanita'),
            'Lansia' => __('Lansia'),
            'Anak-anak' => __('Anak-anak'),
        ];
    }
}

if ( ! function_exists('get_list_read')) {
    function get_list_read()
    {
        return [
            1 => __('general.unread'),
            2 => __('general.read')
        ];
    }
}

if ( ! function_exists('get_list_available')) {
    function get_list_available()
    {
        return [
            80 => __('general.available'),
            99 => __('general.unavailable')
        ];
    }
}

if ( ! function_exists('get_list_type_dose')) {
    function get_list_type_dose()
    {
        return [
            1 => __('general.sebelum_makan'),
            2 => __('general.sesudah_makan'),
            3 => __('Lainnya')
        ];
    }
}

if ( ! function_exists('get_list_type_service')) {
    function get_list_type_service()
    {
        return [
            1 => __('general.no_address'),
            2 => __('general.need_address'),
            3 => __('general.no_address'),
        ];
    }
}

if ( ! function_exists('get_list_type_support')) {
    function get_list_type_support()
    {
        return [
            1 => __('general.phone'),
            2 => __('general.mail')
        ];
    }
}

if ( ! function_exists('get_list_service_payment')) {
    function get_list_service_payment()
    {
        return [
            'xendit' => __('Xendit')
        ];
    }
}

if ( ! function_exists('get_list_type_payment')) {
    function get_list_type_payment()
    {
        return [
            'va_bca' => __('Virtual Account BCA'),
            'va_bri' => __('Virtual Account BRI'),
            'va_bni' => __('Virtual Account BNI'),
            'va_bjb' => __('Virtual Account BJB'),
            'va_cimb' => __('Virtual Account CIMB'),
            'va_mandiri' => __('Virtual Account MANDIRI'),
            'va_permata' => __('Virtual Account PERMATA'),
            'va_sahabat_sampoerna' => __('Virtual Account SAMPOERNA'),
            'ew_ovo' => __('E-Wallet OVO'),
            'ew_dana' => __('E-Wallet DANA'),
            'ew_linkaja' => __('E-Wallet LINKAJA'),
            'ew_shopeepay' => __('E-Wallet SHOPEEPAY'),
            'ew_sakuku' => __('E-Wallet SAKUKU'),
            'qr_qris' => __('QRIS')
        ];
    }
}

if ( ! function_exists('get_list_day')) {
    function get_list_day()
    {
        return [
            1 => __('Monday'),
            2 => __('Tuesday'),
            3 => __('Wednesday'),
            4 => __('Thursday'),
            5 => __('Friday'),
            6 => __('Saturday'),
            7 => __('Sunday'),
        ];
    }
}

if ( ! function_exists('get_list_month')) {
    function get_list_month()
    {
        return [
            1 => __('general.january'),
            2 => __('general.february'),
            3 => __('general.march'),
            4 => __('general.april'),
            5 => __('general.mei'),
            6 => __('general.june'),
            7 => __('general.juli'),
            8 => __('general.augustus'),
            9 => __('general.september'),
            10 => __('general.october'),
            11 => __('general.november'),
            12 => __('general.december')
        ];
    }
}

if ( ! function_exists('get_list_month_data')) {
    function get_list_month_data($month)
    {
        $list_month = get_list_month();
        $month = intval($month);
        return isset($list_month[$month]) ? $list_month[$month] : '';
    }
}

if ( ! function_exists('get_list_data')) {
    function get_list_data($getList)
    {
        $result = [];
        foreach ($getList as $key => $val) {
            $result[] = [
                'id' => $key,
                'name' => $val
            ];
        }
        return $result;
    }
}

if ( ! function_exists('get_list_show_hide')) {
    function get_list_show_hide()
    {
        return [
            1 => __('general.hide'),
            2 => __('general.show')
        ];
    }
}

if ( ! function_exists('get_list_type_klinik')) {
    function get_list_type_klinik()
    {
        return [
            0 => 'Tanpa Instalasi Farmasi',
            1 => 'Instalasi Farmasi'
        ];
    }
}

if ( ! function_exists('get_list_medical_prescription')) {
    function get_list_medical_prescription()
    {
        return [
            0 => 'Tanpa Resep',
            1 => 'Dengan Resep'
        ];
    }
}

if ( ! function_exists('get_list_type_product')) {
    function get_list_type_product()
    {
        return [
            0 => __('general.normal'),
            1 => __('general.obat_keras')
        ];
    }
}

if ( ! function_exists('get_list_weekday')) {
    function get_list_weekday()
    {
        return [
            1 => __('general.monday'),
            2 => __('general.tuesday'),
            3 => __('general.wednesday'),
            4 => __('general.thursday'),
            5 => __('general.friday'),
            6 => __('general.saturday'),
            7 => __('general.sunday'),
        ];
    }
}

if ( ! function_exists('get_list_carbon_day')) {
    function get_list_carbon_day()
    {
        return [
            1 => Carbon::MONDAY,
            2 => Carbon::TUESDAY,
            3 => Carbon::WEDNESDAY,
            4 => Carbon::THURSDAY,
            5 => Carbon::FRIDAY,
            6 => Carbon::SATURDAY,
            7 => Carbon::SUNDAY,
        ];
    }
}

if ( ! function_exists('get_list_schedule_type')) {
    function get_list_schedule_type()
    {
        return [
            1 => __('general.schedule_umum'),
            2 => __('general.schedule_khusus'),
            3 => __('general.schedule_holiday'),
        ];
    }
}

if ( ! function_exists('get_list_sub_service')) {
    function get_list_sub_service()
    {
        return [
            [
                'id' => 1,
                'name' => 'Video Call'
            ],
            [
                'id' => 2,
                'name' => 'Chat'
            ]
        ];
    }
}

if ( ! function_exists('get_list_sub_service2')) {
    function get_list_sub_service2()
    {
        $getList = get_list_sub_service();
        $result = [];
        foreach ($getList as $list) {
            $result[$list['id']] = $list['name'];
        }
        return $result;
    }
}

if ( ! function_exists('get_list_sliders_type')) {
    function get_list_sliders_type()
    {
        return [
            0 => __('general.empty'),
            1 => __('general.website'),
            2 => __('general.menu'),
            3 => __('general.detail'),
        ];
    }
}

if ( ! function_exists('get_list_target_menu_banner')) {
    function get_list_target_menu_banner()
    {
        return [
            1 => __('general.product'),
            2 => __('general.article'),
            3 => __('general.product_detail'),
            4 => __('general.article_detail'),
        ];
    }
}

if ( ! function_exists('get_list_value_target_menu')) {
    function get_list_value_target_menu()
    {
        return [
            1 => 'product',
            2 => 'article',
            3 => 'product_detail',
            4 => 'article_detail',
        ];
    }
}

if ( ! function_exists('get_list_type_service_transaction')) {
    function get_list_type_service_transaction()
    {
        return [
            1 => __('Product'),
            2 => __('Doctor'),
            3 => __('Lab'),
        ];
    }
}

if ( ! function_exists('get_list_type_service_appointment')) {
    function get_list_type_service_appointment()
    {
        return [
            'Homecare' => __('Homecare'),
            'Visit' => __('Visit'),
            'Telemed' => __('Telemed'),
        ];
    }
}

if ( ! function_exists('get_list_type_service_appointment_lab')) {
    function get_list_type_service_appointment_lab()
    {
        return [
            'Homecare' => __('Homecare'),
            'Visit' => __('Visit'),
        ];
    }
}

if ( ! function_exists('get_list_discount_type')) {
    function get_list_discount_type()
    {
        return [
            0 => __('general.no_discount'),
            1 => __('general.nominal'),
            2 => __('general.percentage')
        ];
    }
}

if ( ! function_exists('get_list_item_invoice')) {
    function get_list_item_invoice()
    {
        return [
            'laboratory' => __('general.laboratory'),
            'doctor' => __('general.doctor'),
            'product' => __('general.product'),
        ];
    }
}

if ( ! function_exists('get_list_pharmacy_filter')) {
    function get_list_pharmacy_filter()
    {
        return [
            0 => __('general.without_pharmacy'),
            1 => __('general.with_pharmacy')
        ];
    }
}

if ( ! function_exists('get_list_cash_payment')) {
    function get_list_cash_payment()
    {
        return [
            'cash' => __('general.tunai'),
            'transfer_klinik' => __('general.non_tunai'),
//            'transfer_synapsa' => __('general.transfer_synapsa'),
        ];
    }
}

if ( ! function_exists('get_list_type_service_name')) {
    function get_list_type_service_name()
    {
        return [
            'lab' => __('general.lab'),
            'lab_cash' => __('general.lab'),
            'lab_klinik' => __('general.lab'),
            'product' => __('general.product'),
            'product_cash' => __('general.product'),
            'product_klinik' => __('general.product'),
            'doctor' => __('general.doctor'),
            'doctor_cash' => __('general.doctor'),
        ];
    }
}

if ( ! function_exists('get_list_medipay_promo')) {
    /**
     * @return array
     */
    function get_list_medipay_promo(): array
    {
        return [
            1 => __('general.price_promo'),
            2 => __('general.tax_promo'),
        ];
    }
}

if ( ! function_exists('get_list_medipay_discount_type')) {
    function get_list_medipay_discount_type()
    {
        return [
            1 => __('general.nominal'),
            2 => __('general.percentage')
        ];
    }
}

if ( ! function_exists('get_list_order')) {
    function get_list_order()
    {
        return [
            1 => __('general.pending'),
            2 => __('general.process'),
            3 => __('general.send_driver'),
            4 => __('general.process_lab'),
            80 => __('general.complete'),
            99 => __('general.failed')
        ];
    }
}

if ( ! function_exists('get_list_order_payment')) {
    function get_list_order_payment()
    {
        return [
            1 => __('general.cod'),
            2 => __('general.transfer'),
            3 => __('general.pagu'),
        ];
    }
}

if ( ! function_exists('get_list_status_contact')) {
    /**
     * @return array
     */
    function get_list_status_contact(): array
    {
        return [
            1 => __('general.unread'),
            80 => __('general.read'),
        ];
    }
}