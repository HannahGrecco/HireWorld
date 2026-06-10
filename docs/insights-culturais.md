# Insights Culturais

Gera e exibe informações sobre cultura de negócios de um país usando IA (Google Gemini).

---

## Model — `CulturalInsight`

**Arquivo:** `app/Models/CulturalInsight.php`

| Campo                   | Tipo      | Descrição                                     |
|-------------------------|-----------|-----------------------------------------------|
| `country_id`            | FK        | Referência ao país                            |
| `business_etiquette`    | text      | Como se comportar em reuniões                 |
| `decision_making_style` | text      | Como as decisões são tomadas                  |
| `communication_style`   | text      | Estilo de comunicação predominante            |
| `things_to_avoid`       | text      | O que nunca fazer naquela cultura             |
| `generated_by_ai`       | boolean   | Indica se o conteúdo foi gerado por IA        |
| `generated_at`          | timestamp | Data e hora da geração                        |

**Relacionamento:** `belongsTo(Country::class)`

---

## Migration

**Arquivo:** `database/migrations/2026_05_03_185515_create_cultural_insights_table.php`  
Timestamps adicionados em: `database/migrations/2026_05_13_033925_add_timestamps_to_cultural_insights_table.php`

---

## Service — `CulturalInsightService`

**Arquivo:** `app/Services/CulturalInsightService.php`

**Método:** `getCulturalInsight(Country $country): CulturalInsight|null`

Lógica:
1. Verifica se já existe um insight válido no banco gerado nos últimos 6 meses com todos os campos preenchidos.
2. Se sim, retorna o registro existente (evita nova chamada à IA).
3. Se não, monta um prompt em português e envia para a API do **Gemini 2.5 Flash** via HTTP POST.
4. Valida que a resposta é um JSON com as 4 chaves obrigatórias.
5. Persiste ou atualiza o registro via `updateOrCreate`.
6. Retorna o model atualizado.

**Chave da API:** `config('app.gemini_api_key')` — nunca exposta no código.

Em caso de resposta inválida ou ausência de campos, loga warning e retorna `null`.

---

## Controller — `CountryController`

**Arquivo:** `app/Http/Controllers/CountryController.php`

```php
$serviceInsight = new CulturalInsightService();
$insights = $serviceInsight->getCulturalInsight($country) ?? [];
```

---

## View

**Arquivo:** `resources/views/countries/show.blade.php`

```blade
<p>{{ $insights['business_etiquette'] ?? '—' }}</p>
<p>{{ $insights['decision_making_style'] ?? '—' }}</p>
<p>{{ $insights['communication_style'] ?? '—' }}</p>
<p>{{ $insights['things_to_avoid'] ?? '—' }}</p>
```

Um aviso é exibido abaixo informando que o conteúdo é gerado por IA e deve ser usado como guia.
