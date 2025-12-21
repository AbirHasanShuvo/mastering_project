@extends('master')
{{--
@section('content')
    <h1>This is menu list</h1>
    <table class="">
        <thead>
            <th>
                Menu
            </th>

        </thead>
        <tbody>
            @foreach ($menus as $res)
                <tr>{{ $res->title }}</tr>
            @endforeach
        </tbody>
    </table>
@endsection --}}


@section('content')
    <div class="max-w-12xl mx-auto mt-10">

        <h1 class="text-2xl font-semibold mb-6 text-gray-800">
            Menu List
        </h1>

        <div class="overflow-x-auto bg-white rounded-lg shadow">
            <table class="min-w-full border border-gray-200">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">
                            Title
                        </th>

                        <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">
                            URL
                        </th>



                        <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">
                            Order
                        </th>

                        <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">
                            Active Status
                        </th>

                        <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">
                            Submenu
                        </th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-gray-200">
                    @foreach ($menus as $res)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 text-gray-800">
                                {{ $res->title }}
                            </td>

                            <td class="px-6 py-4 text-blue-600">
                                {{ $res->url }}
                            </td>




                            <td class="px-6 py-4 text-blue-600">
                                {{ $res->order }}
                            </td>

                            <td class="px-6 py-4 text-blue-600">
                                {{ $res->is_active }}
                            </td>

                            <td class="px-6 py-4 text-blue-600">
                                {{-- submenu start --}}

                                <table class="min-w-full border border-gray-500">
                                    <thead>
                                        <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">
                                            Title
                                        </th>
                                        <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">
                                            URL
                                        </th>



                                        <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">
                                            Order
                                        </th>

                                        <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">
                                            Active Status
                                        </th>


                                    </thead>
                                    <tbody class="divide-y divide-gray-200">
                                        @foreach ($res->children as $res2)
                                            <tr>
                                                <td class="px-6 py-4 text-blue-600">
                                                    {{ $res2->title }}
                                                </td>
                                                <td class="px-6 py-4 text-blue-600">
                                                    {{ $res2->url }}
                                                </td>
                                                <td class="px-6 py-4 text-blue-600">
                                                    {{ $res2->order }}
                                                </td>
                                                <td class="px-6 py-4 text-blue-600">
                                                    {{ $res2->is_active }}
                                                </td>
                                            </tr>
                                        @endforeach

                                    </tbody>
                                </table>

                                {{-- submenu end --}}
                            </td>
                        </tr>
                    @endforeach
                </tbody>

            </table>
        </div>

    </div>
@endsection
