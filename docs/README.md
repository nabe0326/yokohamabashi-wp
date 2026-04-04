# Claude Code 実行ガイド

## セットアップ

テーマディレクトリ（既存の雛形がある場所）にファイルを配置:
```
yokohamabashi-theme/
├── CLAUDE.md          ← ここに置く（Claude Codeが自動読み込み）
├── docs/
│   ├── design.md      ← 技術設計（Claudeが必要時に参照）
│   ├── requirements.md
│   └── tasks.md       ← タスク一覧
├── style.css          ← 既存
├── header.php         ← 既存
├── footer.php         ← 既存
└── index.php          ← 既存
```

## 実行方法

### 基本パターン（公式ベストプラクティスに沿った進め方）

**Step 1: 探索→計画（Plan Mode: Shift+Tab 2回）**
```
docs/design.md を読んで、Task 1 の実装計画を立てて。
既存の style.css, header.php, footer.php, index.php の中身も確認して。
```

**Step 2: 実装（Normal Mode に戻す）**
```
その計画で進めて。完了したら php -l で構文チェックして。
```

**Step 3: コミット**
```
変更内容を説明するコミットメッセージで git commit して。
```

**Step 4: 次のタスクへ（/clear でコンテキストリセット）**
```
/clear
docs/tasks.md の Task 2 を実装して。docs/design.md を参照して進めて。
完了したら php -l で構文チェックしてコミットして。
```

### タスクが慣れてきたら（シンプル版）
```
docs/tasks.md の Task N を実装して。docs/design.md を参照。
完了したら構文チェックしてコミット。
```

### コードレビュー（3-4タスクごとに推奨）
```
/clear
コードベース全体をレビューして。
CLAUDE.md のルールに沿っているか、エスケープ漏れがないか確認して。
問題があれば修正して。
```

## Tips

- **1タスク1セッション**: タスク間で `/clear` してコンテキストをクリーンに保つ
- **docs/ はオンデマンド参照**: CLAUDE.md は毎回自動読み込みされるが、docs/ はプロンプトで指示した時だけ読まれる。コンテキストを節約できる
- **具体的に指示する**: 「Task 5 の shop-filter.js だけ実装して」のように絞るとブレにくい
- **検証を含める**: 「実装したら php -l で構文チェックして」「ブラウザで表示確認して」
- **Plan Mode を活用**: 大きいタスク（Task 4, 5）は先に計画を確認してから実装
