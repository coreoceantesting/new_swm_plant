<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WeightMachine extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id','tripID','Ticket_No', 'WeighType', 'Vehicle_No', 'Party_Code', 'Item_Code', 'Charges', 'GrossWt', 'TareWt', 'NetWt', 'GrossDate', 'GrossTime','TareDate', 'TareTime','EntryType', 'PaymentMode', 'Party_Name', 'Product_Name','Field1','Field2','Field3','File_Path_1','File_Path_2','File_Path_3','File_Path_4','File_Path_6','File_Path_7','File_Path_8','Multi_Weigh_Group_No','AutoManual','Weight_Seq','Pcs','Field4','Field5','Field6','Stable_Gross_Tare','Reference_Ticket_No','Wb_Id','Is_Offline_Upload','Net_Date','CoCode','YearID','UserID','EntryDate','UpdateDate'
    ];
}
