<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sale Invoice : {{config('app.name', 'laravel')}}</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <!-- Add your custom stylesheets here -->

    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.18.0/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />

    <!-- Favicon -->
    <!-- Add your favicon link here -->

    <style type="text/css">
        .bdr_1{
            border-bottom: 5px solid#dedede;
        }
        .title_name{
            padding: 5px;
            background: #111111;
            color: #fff;
            border-radius: 10px;
        }
        .custom_font{
            font-size: 10pt;
        }
        .signature{
            margin-top: 70px;
        }
        .signature span{
            border-top: 2px solid#000;
            font-size: 10pt;
            text-align: center;
            padding: 5px 20px;
        }
        @media print {
          /* Set A5 landscape size */
          @page {
            size: A5 landscape;
            margin: 5mm; /* Adjust margins as needed */
            }
            body{
                margin:0px;
            }
            h5{
                font-size: 10pt;
            }
            h6{
                font-size: 8pt;
            }
            .title p{
                font-size: 8pt;
            }
          .custom_font{
                font-size: 8pt;
            }
            .signature{
                margin-top: 50px;
            }
            .signature span{
                border-top: 2px solid#000;
                font-size: 8pt;
                text-align: center;
                padding: 5px 20px;
            }
            .print_btn{
                display: none;
            }
        }
    </style>
</head>
<body>
    <section class="header p-2 bdr_1">
        <div class="container">
        <div class="row">
            <div class="col-md-3">
                <div class="logo">
                    <img src="{{asset('storage/site/'.$siteInfo->app_logo)}}" width="80" alt="logo">
                </div>
            </div>
            <div class="col-md-7">
                <div class="title text-end">
                    <h5 class="mb-0">{{$siteInfo->app_title}}</h5>
                    <p class="mb-0 custom_font" style="white-space: pre-line;">Shop No: 4C-001B1, Block-C, Center Court, 4th Floor,
                    Jamuna Future Park. Kuril, Progoti Shoroni, Dhaka-1229.
                Mobile - 01775-502220.</p>
                </div>
            </div>
            <div class="col-md-2">
                <div class="barcode">
                    {!! DNS1D::getBarcodeSVG($saleInfo->invoice_id, 'C39+', 1, 50) !!}
                </div>
            </div>
        </div>
    </div>
    </section>
    <section class="info">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="mt-1 d-flex justify-content-center">
                        <h5 class="title_name mb-0">Bill / Invoice</h5>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <h6>Bill to -</h6>
                    <div class="customer-info">
                        <table class="custom_font">
                            <tbody>
                            <tr>
                                <td>Customer Name</td>
                                <td class="pe-2 ps-2"> : </td>
                                <td> {{$saleInfo->name}}</td>
                            </tr>
                            <tr>
                                <td>Customer Phone</td>
                                <td class="pe-2 ps-2"> : </td>
                                <td> {{$saleInfo->phone}}</td>
                            </tr>
                            <tr>
                                <td>Customer Address</td>
                                <td class="pe-2 ps-2"> : </td>
                                <td> {{$saleInfo->address}}</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="col-md-6">
                    <h6 class="text-end">Date- {{date('Y-m-d', strtotime($saleInfo->date))}}</h6>
                    <div class="customer-info d-flex justify-content-end">
                        <table class="custom_font">
                            <tbody>
                            <tr>
                                <td>Invoice No</td>
                                <td class="pe-2 ps-2"> : </td>
                                <td> {{$saleInfo->invoice_id}}</td>
                            </tr>
                            <tr>
                                <td>Seller Name</td>
                                <td class="pe-2 ps-2"> : </td>
                                <td> {{$saleInfo->sname}}</td>
                            </tr>
                            <tr>
                                <td>Payment Method</td>
                                <td class="pe-2 ps-2"> : </td>
                                <td> {{$saleInfo->acc_name}}</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="table-responsive product-info mt-3">
                        <table class="table mb-0 table-responsive table-striped custom_font">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Serial No.</th>
                                    <th>Product Name</th>
                                    <th>Model</th>
                                    <th class="text-end">Unit Price</th>
                                    <th class="text-end">Total Price</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($orders as $key => $item)
                                    <tr>
                                        <td>{{$key + 1}}</td>
                                        <td>{{$item->barcode}}</td>
                                        <td>{{$item->name}}</td>
                                        <td>{{$item->model}}</td>
                                        <td class="text-end">{{number_format($item->sale_price, 2)}}</td>
                                        <td class="text-end">{{number_format($item->sale_price, 2)}}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center">Data Not Found</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-9">
                    <div class="notes mt-3">
                        <p class="custom_font mb-1">Taka in Word: Three Thousand Seven Hundred Ninety Six Taka Only.</p>
                        <p class="custom_font">Replacement warranty applicable for one time in whole warranty period.</p>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="signature">
                               <span>Author Signature</span>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="signature">
                                <span>Customer Signature</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <table class="table mb-0 custom_font">
                        <tr>
                            <td class="text-end">Total</td>
                            <td class="text-end">{{number_format($saleInfo->total, 2)}}</td>
                        </tr>
                        <tr>
                            <td class="text-end">Payment</td>
                            <td class="text-end">{{number_format($saleInfo->payment, 2)}}</td>
                        </tr>
                        <tr>
                            <td class="text-end">Due</td>
                            <td class="text-end fw-bolder">{{number_format($saleInfo->due, 2)}}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </section>
    <section class="text-center print_btn mt-5">
        <button type="button" onclick="window.print();" class="btn btn-success"><span class="material-symbols-outlined">print</span></button>
    </section>
    <!-- Bootstrap JS Bundle (Popper included) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Custom JS -->
    <!-- Add your custom scripts here -->

</body>
</html>
