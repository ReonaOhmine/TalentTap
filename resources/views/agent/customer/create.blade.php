<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>ユーザー追加</title>
    <link href="https://cdn.jsdelivr.net/npm/daisyui@4.11.1/dist/full.min.css" rel="stylesheet" type="text/css" />
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
<div class="max-w-[85rem] px-4 py-10 sm:px-6 lg:px-8 lg:py-14 mx-auto">
  <div class="bg-white border border-gray-200 rounded-xl shadow-sm p-6 dark:bg-neutral-800 dark:border-neutral-700">
    <h2 class="text-xl font-semibold text-gray-800 dark:text-neutral-200 mb-6">ユーザー追加</h2>
    <form action="{{ route('agent.customer.store') }}" method="POST">
      @csrf
      <div class="grid gap-6 mb-6 lg:grid-cols-2">
        <div>
          <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-neutral-200">名前</label>
          <input type="text" id="name" name="name" class="block w-full p-2.5 border border-gray-300 rounded-lg shadow-sm dark:bg-neutral-700 dark:border-neutral-600 dark:text-white dark:placeholder-gray-400" placeholder="山田 太郎" required>
        </div>
        <div>
          <label for="position" class="block mb-2 text-sm font-medium text-gray-900 dark:text-neutral-200">ポジション</label>
          <input type="text" id="position" name="position" class="block w-full p-2.5 border border-gray-300 rounded-lg shadow-sm dark:bg-neutral-700 dark:border-neutral-600 dark:text-white dark:placeholder-gray-400" placeholder="開発者" required>
        </div>
        <div>
          <label for="status" class="block mb-2 text-sm font-medium text-gray-900 dark:text-neutral-200">ステータス</label>
          <select id="status" name="status" class="block w-full p-2.5 border border-gray-300 rounded-lg shadow-sm dark:bg-neutral-700 dark:border-neutral-600 dark:text-white dark:placeholder-gray-400" required>
            <option value="active">アクティブ</option>
            <option value="inactive">非アクティブ</option>
            <option value="pending">保留中</option>
          </select>
        </div>
        <div>
          <label for="matching" class="block mb-2 text-sm font-medium text-gray-900 dark:text-neutral-200">マッチング</label>
          <input type="number" id="matching" name="matching" class="block w-full p-2.5 border border-gray-300 rounded-lg shadow-sm dark:bg-neutral-700 dark:border-neutral-600 dark:text-white dark:placeholder-gray-400" placeholder="5" min="0" max="5" required>
        </div>
        <div>
          <label for="created_at" class="block mb-2 text-sm font-medium text-gray-900 dark:text-neutral-200">作成日</label>
          <input type="datetime-local" id="created_at" name="created_at" class="block w-full p-2.5 border border-gray-300 rounded-lg shadow-sm dark:bg-neutral-700 dark:border-neutral-600 dark:text-white dark:placeholder-gray-400" required>
        </div>
      </div>
      <div class="flex justify-end space-x-4">
        <a href="{{ route('agent.customer.index') }}" class="py-2 px-4 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-200 bg-white text-gray-800 shadow-sm hover:bg-gray-50 dark:bg-neutral-800 dark:border-neutral-700 dark:text-white dark:hover:bg-neutral-800">
          キャンセル
        </a>
        <button type="submit" class="py-2 px-4 inline-flex items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700">
          保存
        </button>
      </div>
    </form>
  </div>
</div>
</body>
</html>
