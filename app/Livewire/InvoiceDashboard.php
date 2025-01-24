<?php

namespace App\Livewire;

use Barryvdh\DomPDF\Facade\Pdf;
use Livewire\Component;

class InvoiceDashboard extends Component {
    public $activeTab = 'all Invoices';
    public $invoices = [];

    public function mount() {
        $this->invoices = [
            ['id' => 1, 'currency' => 'USD', 'amount' => '$5.00', 'number' => 'INV-001', 'email' => 'customer1@example.com', 'status' => 'Draft', 'date' => 'Dec 10, 3:36 PM'],
            ['id' => 2, 'currency' => 'USD', 'amount' => '$10.00', 'number' => 'INV-002', 'email' => 'customer2@example.com', 'status' => 'Paid', 'date' => 'Dec 2, 4:20 PM'],
            ['id' => 3, 'currency' => 'USD', 'amount' => '$4.00', 'number' => 'INV-003', 'email' => 'customer3@example.com', 'status' => 'Outstanding', 'date' => 'Nov 21, 5:50 PM'],
            ['id' => 4, 'currency' => 'USD', 'amount' => '$6.00', 'number' => 'INV-004', 'email' => 'customer4@example.com', 'status' => 'Paid', 'date' => 'Nov 18, 12:36 PM'],
            ['id' => 5, 'currency' => 'USD', 'amount' => '$7.00', 'number' => 'INV-005', 'email' => 'customer5@example.com', 'status' => 'Outstanding', 'date' => 'Nov 9, 9:08 PM'],
            ['id' => 6, 'currency' => 'USD', 'amount' => '$8.00', 'number' => 'INV-006', 'email' => 'customer6@example.com', 'status' => 'Paid', 'date' => 'Nov 4, 3:14 PM'],
            ['id' => 7, 'currency' => 'USD', 'amount' => '$10.00', 'number' => 'INV-007', 'email' => 'customer7@example.com', 'status' => 'Draft', 'date' => 'Oct 26, 4:55 PM'],
            ['id' => 8, 'currency' => 'USD', 'amount' => '$9.00', 'number' => 'INV-008', 'email' => 'customer8@example.com', 'status' => 'Paid', 'date' => 'Oct 16, 9:59 PM'],
            ['id' => 9, 'currency' => 'USD', 'amount' => '$3.00', 'number' => 'INV-009', 'email' => 'customer9@example.com', 'status' => 'Outstanding', 'date' => 'Oct 8, 7:14 PM'],
            ['id' => 10, 'currency' => 'USD', 'amount' => '$10.00', 'number' => 'INV-010', 'email' => 'customer10@example.com', 'status' => 'Paid', 'date' => 'Oct 1, 3:37 PM'],
        ];
    }

    public function setTab($tab) {
        $this->activeTab = $tab;
    }

    public function getFilteredInvoicesProperty() {
        if ($this->activeTab === 'all Invoices') {
            return $this->invoices;
        }

        return array_filter($this->invoices, fn($invoice) => $invoice['status'] === ucfirst($this->activeTab));
    }

    public function render() {
        return view('livewire.invoice-dashboard');
    }

    public $dropdowns = [];
    public function toggleDropdown($invoiceId) {
        $this->dropdowns[$invoiceId] = isset($this->dropdowns[$invoiceId]) ? !$this->dropdowns[$invoiceId] : true;
    }

    public function download($invoiceId) {
        $invoice = collect($this->invoices)->firstWhere('id', $invoiceId);

        if (!$invoice) {
            session()->flash('message', "Invoice #{$invoiceId} not found.");
            return;
        }

        $pdf = Pdf::loadView('invoices.pdf', compact('invoice'));

        return response()->streamDownload(
            fn() => print($pdf->output()),
            'Invoice-' . $invoice['number'] . '.pdf'
        );
    }

    public function delete($invoiceId) {
        $this->invoices = array_filter($this->invoices, fn($invoice) => $invoice['id'] !== $invoiceId);
        unset($this->dropdowns[$invoiceId]);
        session()->flash('message', "Invoice #{$invoiceId} deleted");
    }
    
}
