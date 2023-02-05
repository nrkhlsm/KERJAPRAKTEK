<!DOCTYPE html>
<html lang="en">

<head>
     <meta charset="UTF-8">
     {{--
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     --}}
     <meta http-equiv="X-UA-Compatible" content="ie=edge">
     <title>Perseroan Commanditer</title>
     {{--
     <link rel="stylesheet" href="{{ asset('customku/customku.css') }}"> --}}
     <!-- Plugin styles -->
     <style>
          /** Set the margins of the page to 0, so the footer and the header can be of the full height and width ! **/
          @page {
               0cm 0cm;
               Arial,
               Helvetica,
               sans-serif;
               font-size: 11pt;
          }

          /* :root {
     --font-size-11: ;
     --color-black: #212121;
}
 */
          /** Define now the real margins of every page in the PDF **/
          body {
               2cm;
               2cm;
               2cm;
               2cm;
          }

          .margin-paper-1 {
               1cm;
               1cm;
               1cm;
               1cm;
          }

          /** kop surat **/
          .kop-surat {
               /* border: 1;
     */
               text-align: center;
               width: 100%;
          }

          .kop-surat-logo {
               width: 100px;
               height: 100px;
          }

          .page_break {
               page-break-before: always;
          }

          .col-logo {
               width: 0px;
          }

          .br-space-0 {
               display: block;
          }

          .font-display-block {
               display: block;
          }

          .font-size-6 {
               font-size: 6pt;
          }

          .font-size-7 {
               font-size: 6pt;
          }

          .font-size-8 {
               font-size: 8pt;
          }

          .font-size-11 {
               font-size: 11pt;
          }

          .font-size-12 {
               font-size: 12pt;
          }

          .font-size-14 {
               font-size: 14pt;
          }

          .font-size-18 {
               font-size: 18pt;
          }

          /** Text **/
          .text-center {
               text-align: center;
          }

          .text-right {
               text-align: right;
          }

          .text-bold {
               font-weight: bold;
          }

          .text-italic {
               font-style: italic;
          }

          .text-underline {
               text-decoration: underline;
          }

          .text-justify {
               text-align: justify;
               text-justify: inter-word;
          }

          /** Table **/
          .table {
               border: 1px solid;
               border-collapse: collapse;
               width: 100%;
               10px;
               10px;
          }

          .table-2 {
               border: 3px solid;
               border-collapse: collapse;
               width: 100%;
               10px;
               10px;
          }

          table.custom-table tr th {
               border: 1px solid black;
               padding: 4px;
          }

          table.custom-table-0 tr th {
               border: 1px solid black;
          }

          table.custom-table-0 tr td {
               border: 1px solid black;
          }

          table.custom-table tr td {
               border: 1px solid black;
               padding: 4px;
          }

          .table-borderless {
               border: none !important;
          }

          .thead-grey thead {
               background-color: grey;
               color: white;
               border: 1px solid;
          }

          /** Hr **/
          .hr-1 {
               position: relative;
               border: none;
               0px;
               height: 1px;
               flex: none;
               background: black;
          }

          .hr-3 {
               position: relative;
               2px;
               border: none;
               height: 3px;
               flex: none;
               background: black;
          }

          /** Tab (space) **/
          .tab-1 {
               display: inline-block;
               1.27cm;
          }

          /** Padding **/
          .p-1 {
               padding: 1px;
          }

          .p-2 {
               padding: 2px;
          }

          .p-3 {
               padding: 3px;
          }

          .p-4 {
               padding: 4px;
          }

          .pt-1 {
               padding-top: 1px;
          }

          .pt-2 {
               padding-top: 2px;
          }

          .pt-3 {
               padding-top: 3px;
          }

          .pt-4 {
               padding-top: 4px;
          }

          .pt-5 {
               padding-top: 5px;
          }

          .pt-10 {
               padding-top: 10px;
          }

          .pb-1 {
               padding-bottom: 1px;
          }

          .pb-2 {
               padding-bottom: 2px;
          }

          .pb-3 {
               padding-bottom: 3px;
          }

          .pb-4 {
               padding-bottom: 4px;
          }

          .pb-10 {
               padding-bottom: 10px;
          }

          .pr-1 {
               padding-right: 1px;
          }

          .pr-2 {
               padding-right: 2px;
          }

          .pr-3 {
               padding-right: 3px;
          }

          .pr-4 {
               padding-right: 4px;
          }

          .pl-1 {
               padding-left: 1px;
          }

          .pl-2 {
               padding-left: 2px;
          }

          .pl-3 {
               padding-left: 3px;
          }

          .pl-4 {
               padding-left: 4px;
          }

          /** Marg **/
          .p-1 {
               padding: 1px;
          }

          .p-2 {
               padding: 2px;
          }

          .p-3 {
               padding: 3px;
          }

          .p-4 {
               padding: 4px;
          }

          .pt-1 {
               padding-top: 1px;
          }

          .pt-2 {
               padding-top: 2px;
          }

          .pt-3 {
               padding-top: 3px;
          }

          .pt-4 {
               padding-top: 4px;
          }

          .pt-5 {
               padding-top: 5px;
          }

          .pt-20-percen {
               padding-top: 20%;
          }

          .pt-30 {
               padding-top: 30px;
          }

          .pb-1 {
               padding-bottom: 1px;
          }

          .pb-2 {
               padding-bottom: 2px;
          }

          .pb-3 {
               padding-bottom: 3px;
          }

          .pb-4 {
               padding-bottom: 4px;
          }

          .pb-10 {
               padding-top: 10px;
          }

          .pr-1 {
               padding-right: 1px;
          }

          .pr-2 {
               padding-right: 2px;
          }

          .pr-3 {
               padding-right: 3px;
          }

          .pr-4 {
               padding-right: 4px;
          }

          .pr-38 {
               padding-right: 38px;
          }

          .pl-1 {
               padding-left: 1px;
          }

          .pl-2 {
               padding-left: 2px;
          }

          .pl-3 {
               padding-left: 3px;
          }

          .pl-4 {
               padding-left: 4px;
          }

          .pl-20 {
               padding-left: 20px;
          }

          /** Width **/
          .w-0 {
               width: 0px;
          }

          .w-10 {
               width: 10px;
          }

          .w-20 {
               width: 20px;
          }

          .w-30 {
               width: 30px;
          }

          .w-10-percen {
               width: 10%;
          }

          .w-30-percen {
               width: 30%;
          }
     </style>
</head>

<body class="margin-paper-1">
     <table class="kop-surat">
          <tr>
               <td> <span class="font-size-7">DAFTAR PENGAJUAN AKTA PERSEROAN COMMANDITER</span></td>
          </tr>
     </table>
     <br>
     <br>
     <br>
     <span class="font-size-7">Tanggal: {{ date('d-m-Y',strtotime($dateStart)) }} s/d {{
          date('d-m-Y',strtotime($dateEnd))
          }}<span></td>
               <table class="table custom-table-0 font-size-7">
                    <tr>
                         <th>No</th>
                         <td>Pemohon</td>
                         <th>Nama Usaha</th>
                         <th>Alamat</th>
                         <th>KTP</th>
                         <th>NPWP PRIBADI</th>
                    </tr>
                    <tbody>
                         @php
                         $i=1;
                         @endphp
                         @foreach ($perseroanCommanditer as $item)
                         <tr>
                              <td>{{ $i++ }}</td>
                              <td>{{ $item['user']['name'] }}</td>
                              <td>{{ $item['nama_pt'] }}</td>
                              <td>{{ $item['alamat'] }}</td>
                              <td style="text-align: center">
                                   <img width="60" src="{{ asset('asset/ktp/'.$item['ktp']) }}" alt="">
                              </td>
                              <td  style="text-align: center">
                                   <img width="60" src="{{ asset('asset/npwp/'.$item['npwp_pribadi']) }}" alt="">
                              </td>
                         </tr>
                         @endforeach
                    </tbody>
               </table>
               <table class="table table-borderless font-size-7 pt-5">
                    <tbody class="text-center">
                         <tr>
                              <td width="40%"> </td>
                              <td></td>
                              <td width="40%">Jakarta, {{ $dateNowWithoutTime }}<br><br>Penanggung
                                   Jawab<br><br><br><br><br>
                                   <span><u></u></span><br> {{ $user['name'] }}<br>
                              </td>
                         </tr>
                         <tr>
                              <td></td>
                              <td width="20%"> </td>
                              <td></td>
                         </tr>
                         <tr>
                              <td width="40%"> </td>
                              <td></td>
                              <td width="40%"> </td>
                         </tr>
                    </tbody>
               </table>
</body>
<script>
     window.print();
</script>
</html>