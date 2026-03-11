function foo() {}

let a = {
  foo1: 'bar',
  'foo2': 'bar',
  "foo3": 'bar',
  [foo()]: 'bar',
  "foo3": foo(),
}