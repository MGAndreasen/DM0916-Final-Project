using System;
using System.Collections.Generic;
using System.Threading.Tasks;

namespace Worker.WorkQueue
{
    public class Do
    {

        //List<Task> tasks = new List<Task>();
        List<Task<string>> tasks = new List<Task<string>>();

        public Do()
        {

        }

        public string Work() {
            tasks.Add(Task.Factory.StartNew(() => MethodA()));
            tasks.Add(Task.Factory.StartNew(() => MethodB()));
            tasks.Add(Task.Factory.StartNew(() => MethodC()));

            Task.WaitAll(tasks.ToArray());

            foreach (Task t in tasks)
            {
                Console.WriteLine(t.st
                    );
            }

            string hmm = Console.ReadLine();
            Console.WriteLine(hmm);

            return "END";

     
        }

        private string MethodA()
        {
            return "A";
        }

        private string MethodB()
        {
            return "B";
        }

        private string MethodC()
        {
            return "C";
        }
    }
}
