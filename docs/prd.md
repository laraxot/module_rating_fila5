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

## 5. Functional Requirements
### FR-001: Criteria Management
- **Priority**: Must-have
- **Description**: CRUD for evaluation criteria with support for multiple languages.
- **Acceptance Criteria**: Admin can define a criterion and then reuse it in multiple contexts.

### FR-002: Structured Options
- **Priority**: Must-have
- **Description**: Link options to criteria, including their individual score/weight.
- **Acceptance Criteria**: Options can be shared between criteria.

### FR-003: Scoring Engine
- **Priority**: Must-have
- **Description**: Calculate total scores based on weights and selected options.
- **Acceptance Criteria**: Handles multiplication of (Option Score * Criterion Weight).

### FR-004: Schemaless Attributes Support
- **Priority**: Must-have
- **Description**: Use `spatie/laravel-schemaless-attributes` for storing dynamic evaluation data (e.g., year, notes).
- **Acceptance Criteria**: Adheres to the "extra_attributes" pattern for flexible querying.

## 6. Non-Functional Requirements
- **NFR-001: Flexibility**: Must handle any kind of numeric or categorical evaluation scale.
- **NFR-002: Reusability**: Centralized storage to avoid data silos.
- **NFR-003: Type Safety**: PHPStan Level 10 compliance.

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
