<?php

namespace App\Exports;

use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;

class CirurgiasExport implements FromCollection, WithHeadings, ShouldAutoSize, WithStyles
{
    public function styles(Worksheet $sheet)
    {

        return [
            // Style the first row as bold text.
            1    => ['font' => ['italic' => true]],
            3    => ['font' => ['bold' => true]],
        ];
    }


    public function headings(): array
    {
        $date = date('Y-m-d');
        $date1 = str_replace('-', '/', $date);
        $date2 = date('d-m-Y',strtotime($date1 . "-6 days"));

        return [
            [$date2.' à '.date('d-m-Y')],
            [''],
            [
                'PACIENTE',
                'COD PACIENTE',
                'SEXO',
                'DATA NASCIMENTO',
                'Nº ATENDIMENTO',
                'TIPO ATENDIMENTO',
                'DATA ATENDIMENTO',

                'DATA TRIAGEM',
                'Nº TRIAGEM',
                'Nº ATENDIMENTO TRIAGEM',

                'Nº ATENDIMENTO AGENDAMENTO',
                'DATA AGENDAMENTO',

                'CIRURGIA AGENDADA',
                'CARATER',
                'COD PLANO',
                'Nº ATENDIMENTO',
                'Nº CIRURGIA',
                'COD CIRURGIA',
                'COD ANESTESIA',
                'COD SALA',
                'DATA ENTRADA CC',
                'DATA INICIO CIRURGIA',
                'DATA FIM CIRURGIA',
                'DATA SAIDA CC',
                'SOLICITANTE',
                'DESCR CIRURGIA',
                'DURACAO CIRURGIA',
                'PORTE CIRURGIA',
                'PORTE ANESTESICO'],

        ];
    }

    public function collection()
    {

        //$planilha = Storage::path('/public/relatorios/cirurgias.xlsx');

        $date = date('Y-m-d');
        $date1 = str_replace('-', '/', $date);
        $date2 = date('m-d-Y',strtotime($date1 . "-6 days")); //ULTIMOS 7 DIAS


        $cirurgiasSeteDias = DB::connection('pgsql2')
            ->table('PACIENTE.cadpac')
            ->select(
                'cadpac.nomepac',
                'cadpac.codpac',
                'cadpac.sexo',
                'cadpac.datanasc',
                'arqatend.numatend',
                'arqatend.tipoatend',
                'arqatend.datatend',
                'triagem.datatri',
                'triagem.numtriagem',
                'triagem.numatend as numatendtri',
                'ageato.numatend as numatendage',
                'ageato.datamarc',
                'arqcir.agendada',
                'arqcir.carater',
                'arqcir.codplaco',
                'arqcir.numatend as numatendarcir',
                'arqcir.numciru',
                'arqcir.codcir',
                'arqcir.codanest',
                'arqcir.codsala',
                'arqcir.datentcc',
                'arqcir.dataini',
                'arqcir.datafim',
                'arqcir.datsaicc',
                'arqcir.nomesolic',
                'cadcir.descrcir',
                'cadcir.duracao',
                'cadcir.portepmg',
                'cadcir.porteanest')
            ->join('PACIENTE.arqatend','arqatend.codpac', '=', 'cadpac.codpac')
            ->leftjoin('PACIENTE.triagem','triagem.numatend', '=', 'arqatend.numatend')
            ->join('PACIENTE.arqcir','arqcir.numatend', '=', 'arqatend.numatend')
            ->join('PACIENTE.cadcir','cadcir.codcir', '=', 'arqcir.codcir')
            ->leftjoin('PACIENTE.ageato','ageato.nomepac', '=', 'cadpac.nomepac')
            ->where('PACIENTE.arqatend.tipoatend', 'I')
            ->where('PACIENTE.arqatend.datatend','>',$date2)
            ->get();

        //ddd($cirurgiasSeteDias);
        return $cirurgiasSeteDias;

    }
}
