@extends('layouts.appcust')
@section('content')
<br><br><br><br>

<!-- CONTENT =============================-->
<section class="item content">
	<div class="container toparea">
		<div class="underlined-title">
			<div class="editContent">
				<h1 class="text-center latestitems" style="font-size: 18px;">Silahkan isi form dibawah ini :)</h1>
			</div>
			<div class="wow-hr type_short">
				<span class="wow-hr-h">
					<i class="fa fa-star"></i>
					<i class="fa fa-star"></i>
					<i class="fa fa-star"></i>
				</span>
			</div>
		</div>
    <div class="row">
        Bayar Ke NoRek CV Gendhis XXXXXXX-XXXXXXXX-XXXXXXXX
    </div>
    <form action="{{ route('store.pembayaran', ['id' => $data->id]) }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-lg-12">
                <label for="">Kategori Pemesanan</label>
                <input type="text" value="{{ $data->getProdukFromOrder->kategori }}" readonly>
            </div>
            <div class="col-lg-12">
                <label for="">Nama Paket</label>
                @if ($data->getProdukFromOrder->getTravelFromProduk)
                    <input type="text" value="{{ $data->getProdukFromOrder->getTravelFromProduk->nama_paket }}"
                        readonly>
                @endif
                @if ($data->getProdukFromOrder->getBimbelFromProduk)
                    <input type="text" value="{{ $data->getProdukFromOrder->getBimbelFromProduk->nama_paket }}"
                        readonly>
                @endif
                @if ($data->getProdukFromOrder->getFotoFromProduk)
                    <input type="text" value="{{ $data->getProdukFromOrder->getFotoFromProduk->nama_paket }}"
                        readonly>
                @endif
            </div>
            <div class="col-lg-12">
                <label for="">Nama Pemesan</label>
                <input type="text" value="{{ $data->getDetailOrderFromOrder->nama_pemesan }}" readonly>
            </div>
            <div class="col-lg-12">
                <label for="">Jenis Pembayaran</label>
                <input type="text" value="Online" name="jenis" readonly>
            </div>
            <div class="col-lg-12">
                <label for="">Pilih Bank</label>
                <select name="bank" class="@error('bank') is-invalid @enderror">
                    <option value="Mandiri" {{ old('bank') == 'Mandiri' ? 'selected' : '' }}>Mandiri</option>
                    <option value="BCA" {{ old('bank') == 'BCA' ? 'selected' : '' }}>BCA</option>
                    <option value="BRI" {{ old('bank') == 'BRI' ? 'selected' : '' }}>BRI</option>
                    <option value="BTN" {{ old('bank') == 'BTN' ? 'selected' : '' }}>BTN</option>
                    <option value="Lainnya" {{ old('bank') == 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
                </select>

                @error('bank')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="col-lg-12">
                <label for="">Nama Rekening</label>
                <input type="text" class="@error('rek') is-invalid @enderror" name="rek"
                    value="{{ old('rek') }}">

                @error('rek')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="col-lg-12">
                <label for="">Total Pembayaran</label>
                @if ($data->getProdukFromOrder->getTravelFromProduk)
                    <input type="hidden" value="{{ $data->getProdukFromOrder->getTravelFromProduk->harga_paket }}"
                        name="total" readonly>
                    <input type="text" value="{{ $data->getProdukFromOrder->getTravelFromProduk->harga_paket }}"
                        readonly>
                @endif
                @if ($data->getProdukFromOrder->getBimbelFromProduk)
                    <input type="hidden" value="{{ $data->getProdukFromOrder->getBimbelFromProduk->harga_paket }}"
                        name="total" readonly>
                    <input type="text" value="{{ $data->getProdukFromOrder->getBimbelFromProduk->harga_paket }}"
                        readonly>
                @endif
                @if ($data->getProdukFromOrder->getFotoFromProduk)
                    <input type="hidden" value="{{ $data->getProdukFromOrder->getFotoFromProduk->harga_paket }}"
                        name="total" readonly>
                    <input type="text" value="{{ $data->getProdukFromOrder->getBimbelFromProduk->harga_paket }}"
                        readonly>
                @endif
            </div>
            <div class="col-lg-12">
                <label for="">Bukti Pembayaran</label>
                <input type="file" class="@error('bukti') is-invalid @enderror" name="bukti"
                    value="{{ old('bukti') }}">

                @error('bukti')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="col-lg-12">
                <input type="submit" value="Simpan">
            </div>
        </div>
    </form>
    </div>
	</div>
	</div>
	</div>
</section><br><br>
@endsection