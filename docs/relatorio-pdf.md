# Relatório em PDF

Gera e disponibiliza para download um relatório completo do país em formato PDF, consolidando todas as informações disponíveis.

---

## Model

Não possui model próprio. Utiliza os mesmos dados dos outros módulos:
- `Country` — informações gerais do país
- `PublicHoliday` via `HolidayService`
- `CulturalInsight` via `CulturalInsightService`
- `TechSalary` via `TechSalaryService`
- Taxa de câmbio via `ExchangeRateService`

---

## Migration

Não possui migration própria. Depende das tabelas já existentes dos outros módulos.

---

## Controller — `CountryController`

**Arquivo:** `app/Http/Controllers/CountryController.php`  
**Método:** `generatePdf($id)`

Lógica:
1. Busca o país pelo ID com `findOrFail`.
2. Instancia todos os services e coleta os dados (mesmo fluxo do método `show`).
3. Carrega a view `countries.pdf` com todos os dados via `Pdf::loadView()`.
4. Retorna o download com nome `{country->name}-hireworld.pdf`.

```php
public function generatePdf($id) {
    $country = Country::findOrFail($id);
    // ... coleta de dados via services ...
    $pdf = Pdf::loadView('countries.pdf', compact('country', 'holidays', 'rates', 'insights', 'techSalaries'));
    return $pdf->download("{$country->name}-hireworld.pdf");
}
```

**Pacote utilizado:** [`barryvdh/laravel-dompdf`](https://github.com/barryvdh/laravel-dompdf)

---

## Rota

**Arquivo:** `routes/web.php`

```php
Route::get('/countries/{id}/pdf', [CountryController::class, 'generatePdf'])->name('countries.pdf');
```

---

## View

**Arquivo:** `resources/views/countries/pdf.blade.php`

View dedicada exclusivamente para renderização do PDF. Contém o layout formatado para impressão com os dados de:
- Informações gerais do país
- Taxa de câmbio
- Feriados nacionais
- Salários tech
- Insights culturais

---

## View de Acesso

**Arquivo:** `resources/views/countries/show.blade.php`

O botão de download está no cabeçalho da página do país:

```blade
<a href="{{ route('countries.pdf', $country->id) }}" class="...">
    Baixar relatório PDF
</a>
```
