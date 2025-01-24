<div class="p-6 overflow-auto">
    <h1 class="text-2xl font-black mb-4">Invoices</h1>
    <div class="flex space-x-4 border-b mb-6">
        @foreach(['all Invoices', 'draft', 'outstanding', 'paid'] as $tab)
        <button wire:click="setTab('{{ $tab }}')"
            class="py-2 px-4 font-bold {{ $activeTab === $tab ? 'border-b-2 border-blue-500 text-blue-500' : 'text-gray-500' }}">
            {{ ucfirst($tab) }}
        </button>
        @endforeach
    </div>

    <div class="">
        <table class="table-auto w-full text-left border-none">
            <thead>
                <tr style="border-bottom: 1px solid #e5e7eb">
                    <th class="custom-th w-40">AMOUNT</th>
                    <th class="custom-th w-48">STATUS</th>
                    <th class="custom-th w-48">INVOICE NUMBER</th>
                    <th class="custom-th w-sm">CUSTOMER</th>
                    <th class="custom-th w-24">DUE</th>
                    <th class="custom-th w-48">CREATED</th>
                    <th class="custom-th w-24"></th>
                </tr>
            </thead>
            <tbody>
                @foreach($this->filteredInvoices as $invoice)
                <tr class="border-b" wire:key="invoice-{{ $invoice['id'] }}">
                    <td
                        class="px-4 font-semibold {{ $invoice['status'] === 'Draft' ? 'text-gray-400' : 'text-gray-500' }}">
                        {{ $invoice['amount'] }} {{ $invoice['currency'] }} &nbsp;  &nbsp; &nbsp;<i class="fa fa-refresh" style="cursor: pointer" aria-hidden="true"></i></td>
                    <td class="px-4 text-gray-500 font-semibold">
                        <span
                            class="px-2 py-1 rounded {{ $invoice['status'] === 'Paid' ? 'inline-flex items-center rounded-md bg-green-200 px-2 py-1 text-xs font-bold text-green-700' : ($invoice['status'] === 'Draft' ? 'px-2 py-1 rounded inline-flex items-center rounded-md bg-gray-200 px-2 py-1 text-xs font-bold text-gray-700' : 'inline-flex items-center rounded-md bg-yellow-200 px-2 py-1 text-xs font-bold text-yellow-700') }}">
                            {{ $invoice['status'] }}
                        </span>
                    </td>
                    <td class="px-4 text-gray-500 font-semibold">{{ $invoice['number'] }}</td>
                    <td class="px-4 text-gray-500 font-semibold">{{ $invoice['email'] }}</td>
                    <td class="px-4 text-gray-500 font-semibold">&#x2212;</td>
                    <td class="px-4 text-gray-500 font-semibold">{{ $invoice['date'] }}</td>
                    <td class="p-2">
                        <button id="dropdownDefaultButton_{{ $invoice['id'] }}"
                            data-dropdown-toggle="dropdown_{{ $invoice['id'] }}" data-dropdown-offset-skidding="50"
                            data-dropdown-placement="bottom-start"
                            class="inline-flex items-center p-2 text-sm font-medium text-center text-gray-900 bg-white rounded-lg "
                            type="button">
                            <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                fill="currentColor" viewBox="0 0 16 3">
                                <path
                                    d="M2 0a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3Zm6.041 0a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM14 0a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3Z" />
                            </svg>

                        </button>

                        <div id="dropdown_{{ $invoice['id'] }}" wire:ignore
                            class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow-sm w-auto dark:bg-gray-700 dark:divide-gray-600">
                            <ul class="py-2 text-sm text-gray-700 dark:text-gray-200"
                                aria-labelledby="dropdownDefaultButton_{{ $invoice['id'] }}">
                                <li>
                                    <a href="javascript:void(0)"
                                        class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 text-gray-400 dark:hover:text-white font-extrabold">ACTIONS</a>
                                </li>
                                <li>
                                    <a href="javascript:void(0)" wire:click.prevent="download({{ $invoice['id'] }})"
                                        class="block px-4 py-2 hover:bg-gray-100 text-blue-600 font-extrabold text-base">Download
                                        PDF</a>
                                </li>
                                <li>
                                    <a href="javascript:void(0)"
                                        class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 text-blue-600 font-extrabold text-base">Duplicate
                                        invoice</a>
                                </li>
                                <li>
                                    <a href="javascript:void(0)" wire:click="delete({{ $invoice['id'] }})"
                                        class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white text-red-600 font-extrabold text-base">Delete
                                        draft</a>
                                </li>
                            </ul>
                            <div class="py-2">
                                <ul class="py-2 text-sm text-gray-700 dark:text-gray-200"
                                    aria-labelledby="dropdownDefaultButton_{{ $invoice['id'] }}">
                                    <li>
                                        <a href="javascript:void(0)"
                                            class="block px-4 py-2 text-smhover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 text-gray-400 font-extrabold ">
                                            CONNECTIONS</a>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0)"
                                            class="block px-4 py-2 text-smhover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 text-blue-600 font-extrabold text-base">
                                            View Customers <span>&#x2192;</span></a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </td>


                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>