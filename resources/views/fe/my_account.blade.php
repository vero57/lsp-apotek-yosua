<link rel="stylesheet" href="{{ asset('fe/css/myaccount.css') }}">
<link rel="stylesheet" href="{{ asset('fe/style.css') }}">
<link rel="stylesheet" href="{{ asset('fe/css/bootstrap.min.css') }}">
<link rel="stylesheet" href="{{ asset('fe/css/myaccount.css') }}">


<div class="container my-5">
    <div class="max-w-2xl mx-auto bg-white p-5 rounded shadow-sm border">
        <h2 class="text-2xl font-semibold mb-6">Account Settings</h2>

        @if(session('user_id'))
            <form>
                <div class="mb-4">
                    <label class="block font-medium mb-1">Email address</label>
                    <input type="email" class="form-control w-full border border-gray-300 p-2 rounded" 
                           value="{{ session('user_email') }}" disabled>
                </div>

                <div class="mb-4">
                    <label class="block font-medium mb-1">Name</label>
                    <input type="text" class="form-control w-full border border-gray-300 p-2 rounded" 
                           value="{{ session('user_name') }}" disabled>
                </div>

                <div class="mb-4">
                    <label class="block font-medium mb-1">Account Created</label>
                    <input type="text" class="form-control w-full border border-gray-300 p-2 rounded"
                           value="{{ \Carbon\Carbon::parse(session('user_created_at'))->format('d M Y') }}" disabled>
                </div>

                <div class="mb-4">
                    <label class="block font-medium mb-1">No. Telp</label>
                    <input type="text" class="form-control w-full border border-gray-300 p-2 rounded" value="">
                </div>

                <div class="mb-4">
                    <label class="block font-medium mb-1">Alamat 1</label>
                    <input type="text" class="form-control w-full border border-gray-300 p-2 rounded" value="">
                </div>
                <div class="mb-4">
                    <label class="block font-medium mb-1">Kota 1</label>
                    <input type="text" class="form-control w-full border border-gray-300 p-2 rounded" value="">
                </div>
                <div class="mb-4">
                    <label class="block font-medium mb-1">Propinsi 1</label>
                    <input type="text" class="form-control w-full border border-gray-300 p-2 rounded" value="">
                </div>
                <div class="mb-4">
                    <label class="block font-medium mb-1">Kodepos 1</label>
                    <input type="text" class="form-control w-full border border-gray-300 p-2 rounded" value="">
                </div>

                <div class="mb-4">
                    <label class="block font-medium mb-1">Alamat 2</label>
                    <input type="text" class="form-control w-full border border-gray-300 p-2 rounded" value="">
                </div>
                <div class="mb-4">
                    <label class="block font-medium mb-1">Kota 2</label>
                    <input type="text" class="form-control w-full border border-gray-300 p-2 rounded" value="">
                </div>
                <div class="mb-4">
                    <label class="block font-medium mb-1">Propinsi 2</label>
                    <input type="text" class="form-control w-full border border-gray-300 p-2 rounded" value="">
                </div>
                <div class="mb-4">
                    <label class="block font-medium mb-1">Kodepos 2</label>
                    <input type="text" class="form-control w-full border border-gray-300 p-2 rounded" value="">
                </div>

                <div class="mb-4">
                    <label class="block font-medium mb-1">Alamat 3</label>
                    <input type="text" class="form-control w-full border border-gray-300 p-2 rounded" value="">
                </div>
                <div class="mb-4">
                    <label class="block font-medium mb-1">Kota 3</label>
                    <input type="text" class="form-control w-full border border-gray-300 p-2 rounded" value="">
                </div>
                <div class="mb-4">
                    <label class="block font-medium mb-1">Propinsi 3</label>
                    <input type="text" class="form-control w-full border border-gray-300 p-2 rounded" value="">
                </div>
                <div class="mb-4">
                    <label class="block font-medium mb-1">Kodepos 3</label>
                    <input type="text" class="form-control w-full border border-gray-300 p-2 rounded" value="">
                </div>
            </form>
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded">
                    Logout
                </button>
            </form>
        @else
            <div class="alert alert-warning">
                You must be logged in to view this page.
            </div>
        @endif
    </div>
</div>

@include('fe.partials.footer')
