<table width="100%" cellspacing="0" cellpadding="0" border="0">
   <tr>
      <td colspan="6" width="50%"><h1>INVOICE</h1></td>
      <td colspan="6">
{{--          <table>
            <tr align="center">
               <td colspan="3"><h3 style="margin-top: 0px;margin-bottom: 0px">{{ Setting('invoicer.companyName') }}</h3></td>
            </tr>
            <tr>
               <td align="right" width="50%">{{ Setting('invoicer.telephone') }}&nbsp;</td>
               <td>&nbsp;{{ Setting('invoicer.address_1') }}</td>
            </tr>
            <tr>
               <td align="right">{{ Setting('invoicer.email') }}&nbsp;</td>
               <td>&nbsp;{{ Setting('invoicer.address_2') }}</td>
            </tr>
            <tr>
               <td align="right">WSIB N<sup>o</sup>: {{ Setting('invoicer.wsibNo') }}&nbsp;</td>
               <td>&nbsp;{{ Setting('invoicer.city') }}, {{ Setting('invoicer.state') }}</td>
            </tr>
            <tr>
               <td align="right">HST N<sup>o</sup>: {{ Setting('invoicer.hstNo') }}&nbsp;</td>
               <td>&nbsp;{{ Setting('invoicer.zip') }}</td>
            </tr>
         </table> --}}
         <div class="col-sm-12">
            <h3 class="text-center">
               {{ Setting('invoicer.companyName') }}
            </h3>
         </div>
         <div class="row">
            <div class="col-sm-12 text-center">
               {{ Setting('invoicer.address_1') . ', ' }}
               {{ (Setting('invoicer.address_2')) ? Setting('invoicer.address_2') . ', ' : '' }}
               {{ (Setting('invoicer.city')) ? Setting('invoicer.city') . ', ' : '' }}
               {{ (Setting('invoicer.state')) ? Setting('invoicer.state') . ', ' : '' }}
               {{ (Setting('invoicer.zip')) ? Setting('invoicer.zip') : '' }}
               <br />
               @if(Setting('invoicer.telephone') && (Setting('invoicer.fax')))
                  <i class='fas fa-phone'></i> {{ Setting('invoicer.telephone') }} &nbsp;
                  <i class="fas fa-fax"></i> {{ Setting('invoicer.fax') }}
               @elseif(Setting('invoicer.telephone'))
                  <i class='fas fa-phone'></i> {{ Setting('invoicer.telephone') }}
               @elseif (Setting('invoicer.fax'))
                  <i class="fas fa-fax"></i> {{ Setting('invoicer.fax') }}
               @endif

               <br />
               @if(Setting('invoicer.email') && (Setting('invoicer.website')))
                  <i class="fas fa-at"></i> {{ Setting('invoicer.email') }} &nbsp;
                  <i class="fas fa-newspaper"></i> {{ Setting('invoicer.website') }}
               @elseif(Setting('invoicer.email'))
                  <i class="fas fa-at"></i> {{ Setting('invoicer.email') }}
               @elseif(Setting('invoicer.website'))
                  <i class="fas fa-newspaper"></i> {{ Setting('invoicer.website') }}
               @endif

               <br />
               @if(Setting('invoicer.wsibNo') && (Setting('invoicer.hstNo')))
                  WSIB N<sup>o</sup>: {{ Setting('invoicer.wsibNo') }} &nbsp;
                  HST N<sup>o</sup>: {{ Setting('invoicer.hstNo') }}
               @elseif(Setting('invoicer.wsibNo'))
                  WSIB N<sup>o</sup>: {{ Setting('invoicer.wsibNo') }}
               @elseif(Setting('invoicer.hstNo'))
                  HST N<sup>o</sup>: {{ Setting('invoicer.hstNo') }}
               @endif
            </div>
         </div>
      </td>
   </tr>
   <tr>
      <td colspan="12">&nbsp;</td>
   </tr>
   <tr>
      <td colspan="12"><h3 style="margin-top: 0px;margin-bottom: 0px; background-color: #c0c0c0">Invoice Information</h3></td>
   </tr>
   <tr>
      <td colspan="6">
         <table cellspacing="0" cellpadding="0" border="0">
            <tr>
               <th>Billed To</th>
            </tr>
            <tr>
               <td>
                  {{ $invoice->client->company_name }}<br />
                  {{ $invoice->client->address }}<br />
                  {{ $invoice->client->city }}, {{ $invoice->client->state }}<br />
                  {{ $invoice->client->zip }}
               </td>
            </tr>
         </table>
      </td>
      <td colspan="6" valign="top">
         <table width="100%" cellspacing="0" cellpadding="0" border="0">
            <tr>
               <th width="50%" align="right">Invoice N<sup>o</sup></th>
               <td width="50%" align="right">{{ $invoice->id }}</td>
            </tr>
            <tr>
               <th width="50%" align="right">Invoice Date</th>
               <td width="50%" align="right">{{ $invoice->invoiced_at->format('M d, Y') }}</td>
            </tr>
         </table>
      </td>
   </tr>
   <tr>
      <td colspan="12">&nbsp;</td>
   </tr>
   <tr>
      <th colspan="12" style="background-color: #c0c0c0">Work Description</th>
   </tr>
   <tr>
      <td colspan="12">{{ $invoice->work_description ?? 'N/A' }}</td>
   </tr>
   <tr>
      <td colspan="12">&nbsp;</td>
   </tr>
   <tr>
      <th colspan="12" style="background-color: #c0c0c0;">Billable Items</th>
   </tr>
   <tr>
      <td colspan="12">
         @if($invoice->invoiceItems->count() > 0)
            <table border="0" width="100%" cellpdding="0" cellspacing="0">
               <thead>
                  <tr>
                     <th>Product</th>
                     <th nowrap="nowrap">Work Date</th>
                     <th>Notes</th>
                     <th align="center">Quantity</th>
                     <th align="right">Price</th>
                     <th align="right">Amount</th>
                  </tr>
               </thead>
               <tbody>
                  @foreach($invoice->invoiceItems->sortByDesc('work_date') as $item)
                     <tr>
                        <td>{{ $item->product->details }}</td>
                        <td nowrap="nowrap">{{ $item->work_date->format('M d, Y') }}</td>
                        <td>{!! nl2br(e($item->notes)) !!}</td>
                        <td align="center" nowrap="nowrap">{{ $item->quantity }}</td>
                        <td align="right" nowrap="nowrap">{{ number_format($item->price, 2, '.', ' ') }}$</td>
                        <td align="right" nowrap="nowrap">{{ number_format($item->total, 2, '.', ' ') }}$</td>
                     </tr>
                  @endforeach
               </tbody>
            </table>
         @else
            <table cellspacing="0" cellpadding="0" border="0">
               <tr>
                  <td colspan="12">No related billable items found.</td>
               </tr>
            </table>
         @endif
      </td>
   </tr>
   <tr>
      <td colspan="12">&nbsp;</td>
   </tr>
   <tr>
      <th colspan="12" style="background-color: #c0c0c0">Terms and Conditions</th>
   </tr>
   <tr>
      <td colspan="12">{!! Config::get('invoicer.termsAndConditions') !!}</td>
   </tr>
   <tr>
      <td colspan="12">&nbsp;</td>
   </tr>
   <tr>
      <td colspan="12">
         <table width="100%" cellspacing="0" cellpadding="0" border="0">
            <tr>
               <th width="80%" align="right">SubTotal</th>
               <td width="20%" align="right">{{ ($invoice->amount_charged ? number_format($invoice->amount_charged, 2, '.', ' ') : '0.00') }}$</td>
            </tr>
            <tr>
               <th width="80%" align="right">HST</th>
               <td width="20%" align="right">{{ number_format($invoice->hst, 2, '.', ' ') }}$</td>
            </tr>
            <tr>
               <td colspan="2">&nbsp;</td>
            </tr>
            <tr>
               <th width="80%" align="right">Total</th>
               <td width="20%" align="right">{{ number_format($invoice->sub_total, 2, '.', ' ') }}$</td>
            </tr>
         </table>
      </td>
   </tr>
</table>
