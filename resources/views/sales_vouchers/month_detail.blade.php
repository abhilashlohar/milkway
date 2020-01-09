<?php for($i=1;$i<=$request->days;$i++){ 
$date = $i.'-'.$request->month.'-'.$request->year;
?>
<tr class="main_tr" class="tab">
    <td align="center" width="1px">{{ $i }}</td>
    <td width="36px">
        <input type="input" name="sales_voucher_rows[{{ $i }}][month_date]" value="{{ $i.'-'.$request->month.'-'.$request->year }}" class="form-control" readonly>
    </td>
    <td width="63px">
        <input id="qty" type="number" class="form-control @error('qty') is-invalid @enderror" name="sales_voucher_rows[{{ $i }}][qty]" value="{{ @$arr[@$month][date('d-m-Y',strtotime($date))] }}"  step="any">
        <input type="hidden" name="sales_voucher_rows[{{ $i }}][id]" value="{{ @$ids[@$month][date('d-m-Y',strtotime($date))] }}">
    </td>
</tr>
<?php } ?>                                       