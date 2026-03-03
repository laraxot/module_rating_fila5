# Rating - Product Requirements Document (PRD)

> **Version**: 1.0.0
> **Last Updated**: 2026-03-03
> **Status**: Approved
> **Owner**: Rating Module Team

## 1. Purpose & Vision
The Rating module is the **dynamic criteria and scoring engine** for the PTVX platform. It provides a highly configurable framework to define evaluation scales, weighted criteria, and scoring options that can be utilized by other modules (Performance, Incentives, Allowances) to handle complex, rule-based evaluations without duplicating code.

## 2. Problem Statement
Multiple modules in Laraxot need to:
- Define complex evaluation forms with varying scoring methods (Likert, points, yes/no).
- Assign weights to different sections and criteria.
- Calculate final scores based on hierarchical rules.
- Maintain a reusable library of criteria to ensure consistency across the platform.
- Store results efficiently using schemaless attributes for flexibility.

## 3. Target Users
| User | Role | Needs |
|------|------|-------|
| **Developer** | Module Builder | Utilize the Rating engine for new valuation features. |
| **System Admin** | Global Configurator | Define the organization's standard evaluation scales and criteria. |
| **HR Specialist** | Template Manager | Create reusable evaluation templates for various HR processes. |

## 4. Scope
### In Scope
- Managed library of Evaluation Criteria (Criteri).
- Managed library of Criterion Options (e.g., 1-5 scales, Yes/No).
- Weighting system for criteria and sections.
- Scoring engine for result calculation.
- Support for Schemaless Attributes to store arbitrary evaluation metadata.
- Traits and contracts for easy integration with other Eloquent models.
- Filament resources for criteria and templates management.

### Out of Scope
- User-facing evaluation UI (this is a backend engine / admin tool).
- Specific business logic (logic lives in the consumer modules).

## 5. Functional Requirements (Prioritized)

### P0: Scoring Engine (Must-have)
- **FR-001: Global Criteria Registry**: Centralized library of evaluation criteria with support for weights and multiple languages.
- **FR-002: Flexible Scoring Scales**: Define diverse options (Likert, Numeric, Binary) linked to specific criteria points.
- **FR-004: Schemaless Result Storage**: Use of `spatie/laravel-schemaless-attributes` for flexible metadata (e.g., year, evaluator notes) without migrations.

### P1: Template Management (Important)
- **FR-005: Reusable Templates**: Group criteria into templates for consistent application across `Performance`, `Incentivi`, and `Indennita`.
- **FR-006: Dynamic Calculation Engine**: Hierarchical result calculation based on section and criterion weights.

### P2: Advanced Intelligence (Nice-to-have)
- **FR-007: Visual Weight Balancer**: Admin interface to visually adjust weights and see the impact on total scores in real-time.
- **FR-008: AI Criteria Suggestions**: Recommend relevant evaluation criteria based on the module context or job role.

## 6. Non-Functional Requirements & Agnostic Design

### Agnostic Design Principles
- **Domain-Agnostic Engine**: Rating provides the evaluation logic; it MUST NOT depend on the specific thing being rated.
- **Interoperability**: Provides standardized traits and contracts for any module to "enable" rating capabilities on its models.
- **Isolation**: Evaluation results are managed via dedicated models, preventing data pollution in consumer modules.

### Performance & Safety
- **NFR-001: Scalability**: Support for complex evaluations with 100+ criteria without performance degradation.
- **NFR-002: Integrity**: Strict adherence to the `withExtraAttributes` query pattern to ensure data consistency.
- **NFR-003: Type Safety**: 100% PHPStan Level 10 compliance.

## 7. Technical Architecture
### Dependencies
- **Xot**: Base core.
- `spatie/laravel-schemaless-attributes`: For flexible data storage.
### Integration Points
- **Consumer Modules**: `Performance`, `IndennitaResponsabilita`, `Incentivi` all use Rating to power their forms.
### Core Rule
- NEVER use `wherePivot` for `extra_attributes`. Query the `Rating` model directly using `withExtraAttributes`.

## 8. User Experience
- (Admin) Interactive builder to create criteria sets.
- (Admin) Clear preview of how a score will be calculated.

## 9. Success Metrics & KPIs
| Metric | Target | Measurement |
|--------|--------|-------------|
| Code Reuse | > 80% | Percentage of evaluation logic moved to Rating. |
| Query Performance | < 50ms | Retrieval of complex criteria sets. |
| PHPStan Compliance | Level 10 | Static analysis result. |

## 10. Risks & Assumptions
### Assumptions
- Evaluations can be broken down into discrete criteria and options.
- Numeric weights are the primary way to calculate relative importance.
### Risks
| Risk | Impact | Mitigation |
|------|--------|------------|
| Circular dependencies | Low | Strong decoupling from consumer modules. |
| Complex query performance | Medium | Use optimized scopes for schemaless attributes. |

## 11. Dependencies & Constraints
- Must remain agnostic of the specific thing being rated.

## 12. Release Plan
### Phase 1: Core Engine (Stable)
- Criteria and Options management. ✅
- Basic scoring logic. ✅
- PHPStan Level 10 compliance. ✅
### Phase 2: Template system (Planned)
- Grouping criteria into "Templates" for easy consumption.
- Visual weight balancer UI.

## 13. References
- [roadmap.md](roadmap.md)
- [module-analysis.md](module-analysis.md)
- [has-xot-table-zen.md](../../Xot/docs/has-xot-table-zen.md)
