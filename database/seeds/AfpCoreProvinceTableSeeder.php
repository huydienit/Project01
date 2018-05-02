<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AfpCoreProvinceTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $arrName = array('Hà Nội', 'TP.Hồ Chí Minh', 'Hải Phòng', 'Điện Biên', 'Lai Châu', 'Sơn La', 'Lào Cai', 'Yên Bái', 'Hà Giang', 'Tuyên Quang', 'Cao Bằng', 'Lạng Sơn', 'Bắc Cạn', 'Thái Nguyên', 'Quảng Ninh', 'Hòa Bình', 'Bắc Giang', 'Bắc Ninh', 'Phú Thọ', 'Vĩnh Phúc', 'Hải Dương', 'Hưng Yên', 'Thái Bình', 'Hà Nam', 'Nam Định', 'Ninh Bình', 'Thanh Hóa', 'Hà Tĩnh', 'Nghệ An', 'Quảng Bình', 'Quảng Trị', 'Thừa Thiên Huế', 'Đà Nẵng', 'Quảng Nam', 'Bình Định', 'Quảng Ngãi', 'Khánh Hòa', 'Phú Yên', 'Kon Tum', 'Gia Lai', 'Đắc Lắc', 'Lâm Đồng', 'Bình Thuận', 'Đắc Nông', 'Ninh Thuận', 'Bà Rịa - Vũng Tàu', 'Đồng Nai', 'Bình Dương', 'Bình Phước', 'Tây Ninh', 'Long An', 'Tiền Giang', 'Bến Tre', 'Trà Vinh', 'Vĩnh Long', 'Đồng Tháp', 'An Giang', 'Cần Thơ', 'Hậu Giang', 'Sóc Trăng', 'Kiên Giang', 'Bạc Liêu', 'Cà Mau');
        $arrCode = array('1,11', '2', '3', '4', '4', '5', '6', '6', '7', '7', '8', '8', '9', '9', '10', '11', '12', '12', '13', '13', '14', '14', '15', '16', '16', '16', '17', '18', '18', '19', '19', '19', '20', '20', '21', '21', '22', '22', '23', '230,231', '24', '25', '26', '26', '26', '27', '27', '28', '28', '29', '30', '31', '32', '33', '33', '34', '35', '36', '36', '36', '37', '38', '38');
        $arrCodeNew = array('1', '79', '31', '11', '12', '14', '10', '15', '2', '8', '4', '20', '6', '19', '22', '17', '24', '27', '25', '26', '30', '33', '34', '35', '36', '37', '38', '42', '40', '44', '45', '46', '48', '49', '52', '51', '56', '54', '62', '64', '66', '68', '60', '67', '58', '77', '75', '74', '70', '72', '80', '82', '83', '84', '86', '87', '89', '92', '93', '94', '91', '95', '96');
        foreach ($arrName as $key => $value) {
            $dataInsert[] = [
                'name' => $arrName[$key],
                'code' => $arrCode[$key],
                'code_new' => $arrCodeNew[$key]
            ];
        }
        DB::table('afp_province')->insert($dataInsert);
    }
}
