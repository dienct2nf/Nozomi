<?php

namespace App\Exports;

use App\Models\Customer;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class CustomerExport implements FromCollection , WithHeadings, WithMapping
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Customer::all();
    }

    public function map($customer): array
    {
        return [
            $customer->id,
            $customer->full_name,
            date('d/m/Y', strtotime($customer->birth_day)),
            $customer->phone,
            $customer->address,
            $customer->sex,
            $customer->created_at->format('H:i d/m/Y'),
            $customer->email,
            !empty($customer->order->first()->products)? $customer->order->first()->products->first()->name : 'Chưa xác định',
        ];
    }

    public function headings(): array
    {
        return [
            '#',
            'Họ và tên',
            'Ngày sinh',
            'Số điện thoại',
            'Địa chỉ',
            'Giới tính',
            'Ngày đăng ký',
            'Email',
            'Đơn hàng'
        ];
    }
}
