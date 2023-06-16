<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            User &raquo; {{$item->name}} &raquo; Edit
        </h2>
    </x-slot>


    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div>
                @if ($errors->any())
                    <div class="mb-5" role="alert">
                        <div class="bg-red-500 text-white font-bold rounded-t px-4 py-2">
                            Theres Someting Wrong
                        </div>
                        <div class="border border-t-0 border-red-400 rounded-b bg-red-100 px-4 py-3 text-red-700">
                            <p>
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{$error}}</li>
                                    @endforeach
                                </ul>
                            </p>
                        </div>
                    </div>
                @else
                    
                @endif
                <form action="{{ route('dashboard.user.update' , $item->id)}} " class="w-full" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="flex-warp -mx-3 mb-3">
                        <div class="w-full px-3">
                            <label for="" class="block uppercase tracking-wide text-grey-700 text-xs font-bold mb-2">Name</label>
                            <input type="text" value="{{old('name') ?? $item->name}}" name="name" class="block w-full bg-grey-200 text-grey-700 border border-grey-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500 mb-2" placeholder="Enter Name">
                        </div>
                        <div class="w-full px-3">
                            <label for="" class="block uppercase tracking-wide text-grey-700 text-xs font-bold mb-2">Email</label>
                            <input type="text" value="{{old('email') ?? $item->email}}" name="email" class="block w-full bg-grey-200 text-grey-700 border border-grey-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500 mb-2" placeholder="Enter Email">
                        </div>
                        <div class="w-full px-3 mt-2">
                            <label for="" class="block uppercase tracking-wide text-grey-700 text-xs font-bold mb-2">Price</label>
                            <select name="roles" id="" class="block w-full bg-grey-200 text-grey-700 border border-grey-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500 mb-2" placeholder="Product Name">
                                <option value="{{$item->roles}}">{{$item->roles}}</option>
                                <option disable>----------</option>
                                <option value="ADMIN">ADMIN</option>
                                <option value="USER">USER</option>
                            </select>
                        </div>
                        <div class="w-full px-3 mt-2">
                            <button type="submit" class=" mt-3 bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded shadow-lg">
                                Submit
                            </button>
                            <a href="{{route('dashboard.index')}}" class="mt-3 bg-orange-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded shadow-lg">Back</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
